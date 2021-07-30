<?php

namespace App\Controller;

use App\Entity\User;
use App\Hydrator;
use App\Repository\UserRepository;
use App\Validator\Validator;
use Twig\Environment;

class DashboardController extends AbstractController
{
    private Validator $validator;
    private Hydrator $hydrator;
    private UserRepository $repository;

    public function __construct(Environment $twig)
    {
        parent::__construct($twig);
    }

    /**
     * Dashboard.
     *
     * @route /mon-compte
     *
     * @method GET - POST
     */
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            return $this->redirect('/connexion');
        }

        if (!empty($_POST)) {
            $user = new User();
            $this->repository = new UserRepository();
            $passwordUpdated = false;

            // Si l'utilisateur n'a pas renseigné de nouveau mdp
            if ($_POST['password'] === '') {
                $userPasswordHash = $this->repository->getUserPasswordHash($_SESSION['user']);
                // On recupere son mdp en session
                $_POST['password'] = $userPasswordHash;
            } else {
                $passwordUpdated = true;
            }

            // On validate notre object user
            $this->validator = new Validator();
            $errors = $this->validator->validate($user, $_POST);

            if (!empty($errors)) {
                return $this->render(
                    'dashboard.html.twig',
                    ['errors' => $errors, 'post_data' => $_POST]
                );
            }

            // On hydrate notre user
            $this->hydrator = new Hydrator();
            $this->hydrator->hydrate($user, $_POST);

            $user->setImageUrl($_SESSION['user']->getImageUrl());

            // Si l'utilisateur a renseigne un nouveau mdp
            if ($passwordUpdated) {
                // On hashe le nouveau mdp
                $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            }

            $this->repository->updateUser($user);

            // On stocke les nouvelles infos du user en session
            $_SESSION['user']->setLastname($user->getLastname());
            $_SESSION['user']->setFirstname($user->getFirstname());

            return $this->render('dashboard.html.twig', ['message' => 'Votre profil a bien été modifié.']);
        }

        return $this->render('dashboard.html.twig');
    }
}
