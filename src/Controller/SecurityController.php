<?php

namespace App\Controller;

use App\Entity\User;
use App\Helpers;
use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\UserRepository;
use App\Validator\Validator;
use Twig\Environment;

class SecurityController extends AbstractController
{
    private UserRepository $repository;
    private Hydrator $hydrator;

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        $this->repository = new UserRepository();
        $this->hydrator = new Hydrator();
        parent::__construct($twig, $request, $session, $files);
    }

    /**
     * Register new user.
     *
     * @route /inscriptions
     */
    public function register(): string
    {
        if (!empty($this->request->getParams('POST'))) {
            $user = new User();

            $validator = new Validator();
            $errors = $validator->validate($user, $this->request->getParams('POST'));

            if (!empty($errors)) {
                return $this->render('register.html.twig', ['errors' => $errors]);
            }

            $this->hydrator->hydrate($user, $this->request->getParams('POST'));
            $user->setPassword(password_hash($this->request->getParam('POST', 'password'), PASSWORD_DEFAULT));

            $token = Helpers::generateToken();
            $user->setConfirmationToken($token);

            if ($this->repository->userExist($user)) {
                return $this->render('register.html.twig', [
                    'error' => 'Un utilisateur avec cet email existe déjà. Vous pouvez vous <a href="/connexion">connecter</a> ou réinitialiser votre mot de passe si vous l\'avez oublié.',
                    'post' => $this->request->getParams('POST'),
                ]);
            }

            $user_id = $this->repository->addUser($user);

            if ($user_id) {
                $user->setId($user_id);

                mail(
                    $user->getEmail(),
                    'Confirmation de votre compte',
                    "Pour confirmer cotre compte, veuillez cliquer sur le lien suivant.\n{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/confirmer-compte/$user_id-$token"
                );

                return $this->render(
                    'register.html.twig',
                    ['message' => 'Un mail de confirmation vient de vous être envoyé. Veuillez cliquer sur le lien afin de confirmer votre comtpe.']
                );
            }
        }

        return $this->render('register.html.twig');
    }

    /**
     * Login.
     *
     * @route /connexion
     */
    public function login(): ?string
    {
        if ($this->session->get('user') !== null) {
            return $this->redirect('/mon-compte');
        }

        if (!empty($this->request->getParams('POST'))) {
            $user = new User();
            $this->hydrator->hydrate($user, $this->request->getParams('POST'));

            $user_data = $this->repository->userExist($user);

            // Si aucun utilisateur avec cet email existe
            if (!$user_data) {
                return $this->render('login.html.twig', ['error' => "L'email renseigné ne correspond à aucun utilisateur"]);
            }

            // Si le compte n'a pas été confirmé
            if (!$this->repository->checkConfirmUser($user_data)) {
                return $this->render(
                    'login.html.twig',
                    ['error' => "Votre compte n'a pas été confirmé, un email vous a été envoyé lors de la création de celui-ci, veuillez cliquer sur le lien contenu dans cet email.", 'post' => $this->request->getPostParams()]
                );
            }

            // Si le password ne match pas le hash stocké en base
            if (!password_verify($this->request->getParam('POST', 'password'), $this->repository->getUserPasswordHash($user_data))) {
                return $this->render('login.html.twig', ['error' => 'Le couple email / mot de passe est incorrect.', 'post' => $this->request->getParams('POST')]);
            }

            // On stocke les infos du user en session
            $this->session->set('user', $user_data);

            return $this->redirect('/mon-compte');
        }

        return $this->render('login.html.twig');
    }

    /**
     * Confirm account.
     *
     * @route /confirmation/:id-:token
     *
     * @method GET
     */
    public function confirmAccount(string $id, string $token): ?string
    {
        if (!$this->repository->confirmUser($id, $token)) {
            return $this->render(
                'register.html.twig',
                ['error' => 'Une erreur s\'est produite lors de la validation de votre compte. Veuillez réessayer.']
            );
        }

        $this->redirect('/connexion');
    }

    /**
     * Logout.
     *
     * @route /deconnexion
     */
    public function logout()
    {
        if ($this->session->get('user') === null) {
            return $this->redirect('/');
        }

        $this->session->delete('user');

        return $this->redirect('/');
    }
}
