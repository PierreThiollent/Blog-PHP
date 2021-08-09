<?php

namespace App\Controller;

use App\Entity\User;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\UserRepository;
use App\Validator\Validator;
use Twig\Environment;

class DashboardController extends AbstractController
{

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        parent::__construct($twig, $request, $session, $files);
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
        if ($this->session->get('user') === null) {
            return $this->redirect('/connexion');
        }

        if (!empty($this->request->getParams('POST'))) {
            $user = new User();
            $repository = new UserRepository();
            $passwordUpdated = false;

            // Si l'utilisateur n'a pas renseigné de nouveau mdp
            if ($this->request->getParam('POST', 'password') === '') {
                $userPasswordHash = $repository->getUserPasswordHash($this->session->get('user'));
                // On recupere son mdp en session
                $this->request->setParam('POST', 'password', $userPasswordHash);
            } else {
                $passwordUpdated = true;
            }

            // On validate notre object user
            $validator = new Validator();
            $errors = $validator->validate($user, $this->request->getParams('POST'));

            if (!empty($errors)) {
                return $this->render(
                    'dashboard.html.twig',
                    ['errors' => $errors, 'post_data' => $this->request->getParams('POST')]
                );
            }

            // On hydrate notre user
            $hydrator = new Hydrator();
            $hydrator->hydrate($user, $this->request->getParams('POST'));

            // On ecrase les propriétés par defaut d'un user
            $user->setImageUrl($this->session->get('user')->getImageUrl());
            $user->setId($this->session->get('user')->getId());
            $user->setRole($this->session->get('user')->getRole());

            // Si l'utilisateur a renseigne un nouveau mdp
            if ($passwordUpdated) {
                // On hashe le nouveau mdp
                $user->setPassword(password_hash($this->request->getParam('POST', 'password'), PASSWORD_DEFAULT));
            }

            $repository->updateUser($user);

            // On stocke les nouvelles infos du user en session
            $this->session->set('user', $user);

            return $this->render('dashboard.html.twig', ['message' => 'Votre profil a bien été modifié.']);
        }

        return $this->render('dashboard.html.twig');
    }
}
