<?php

namespace App\Controller;

use App\Entity\User;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\UserRepository;
use App\Validator\Validator;
use Twig\Environment;

class DashboardController extends AbstractController
{
    private Validator $validator;
    private Hydrator $hydrator;
    private UserRepository $repository;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        parent::__construct($twig, $request, $session);
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
        if (is_null($this->session->get('user'))) {
            return $this->redirect('/connexion');
        }

        if (!empty($this->request->getPostParams())) {
            $user = new User();
            $this->repository = new UserRepository();
            $passwordUpdated = false;

            // Si l'utilisateur n'a pas renseigné de nouveau mdp
            if ($this->request->getPostParam('password') === '') {
                $userPasswordHash = $this->repository->getUserPasswordHash($this->session->get('user'));
                // On recupere son mdp en session
                $this->request->setPostParam('password', $userPasswordHash);
            } else {
                $passwordUpdated = true;
            }

            // On validate notre object user
            $this->validator = new Validator();
            $errors = $this->validator->validate($user, $this->request->getPostParams());

            if (!empty($errors)) {
                return $this->render(
                    'dashboard.html.twig',
                    ['errors' => $errors, 'post_data' => $this->request->getPostParams()]
                );
            }

            // On hydrate notre user
            $this->hydrator = new Hydrator();
            $this->hydrator->hydrate($user, $this->request->getPostParams());

            $user->setImageUrl($this->session->get('user')->getImageUrl());

            // Si l'utilisateur a renseigne un nouveau mdp
            if ($passwordUpdated) {
                // On hashe le nouveau mdp
                $user->setPassword(password_hash($this->request->getPostParam('password'), PASSWORD_DEFAULT));
            }

            $this->repository->updateUser($user);

            // On stocke les nouvelles infos du user en session
            $this->session->set('user', $user);

            return $this->render('dashboard.html.twig', ['message' => 'Votre profil a bien été modifié.']);
        }

        return $this->render('dashboard.html.twig');
    }
}
