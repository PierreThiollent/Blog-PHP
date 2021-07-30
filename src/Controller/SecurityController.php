<?php

namespace App\Controller;

use App\Entity\User;
use App\Helpers;
use App\Hydrator;
use App\Repository\UserRepository;
use App\Validator\Validator;
use Twig\Environment;

class SecurityController extends AbstractController
{
    private UserRepository $repository;
    private Hydrator $hydrator;

    public function __construct(Environment $twig)
    {
        $this->repository = new UserRepository();
        $this->hydrator = new Hydrator();
        parent::__construct($twig);
    }

    /**
     * Register new user.
     *
     * @route /inscription
     *
     * @return void
     */
    public function register()
    {
        if (!empty($_POST)) {
            $user = new User();

            $validator = new Validator();
            $errors = $validator->validate($user, $_POST);

            if (!empty($errors)) {
                return $this->render('register.html.twig', ['errors' => $errors]);
            }

            $this->hydrator->hydrate($user, $_POST);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));

            $token = Helpers::generateToken();
            $user->setConfirmationToken($token);

            if ($this->repository->userExist($user)) {
                return $this->render('register.html.twig', [
                    'error' => 'Un utilisateur avec cet email existe déjà. Vous pouvez vous <a href="/connexion">connecter</a> ou réinitialiser votre mot de passe si vous l\'avez oublié.',
                    'post'  => $_POST,
                ]);
            }

            $user_id = $this->repository->addUser($user);

            if ($user_id) {
                $user->setId($user_id);

                mail(
                    $user->getEmail(),
                    'Confirmation de votre compte',
                    "Pour confirmer cotre compte, veuillez cliquer sur le lien suivant.\n{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/confirmation/$user_id-$token"
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
     *
     * @return void
     */
    public function login()
    {
        if (isset($_SESSION['user'])) {
            return $this->redirect('/mon-compte');
        }

        if (!empty($_POST)) {
            $user = new User();
            $this->hydrator->hydrate($user, $_POST);

            $user_data = $this->repository->userExist($user);

            // Si aucun utilisateur avec cet email existe
            if (!$user_data) {
                return $this->render('login.html.twig', ['error' => "L'email renseigné ne correspond à aucun utilisateur"]);
            }

            // Si le compte n'a pas été confirmé
            if (!$this->repository->checkConfirmUser($user_data)) {
                return $this->render(
                    'login.html.twig',
                    ['error' => "Votre compte n'a pas été confirmé, un email vous a été envoyé lors de la création de celui-ci, veuillez cliquer sur le lien contenu dans cet email.", 'post' => $_POST]
                );
            }

            // Si le password ne match pas le hash stocké en base
            if (!password_verify($_POST['password'], $this->repository->getUserPasswordHash($user_data))) {
                return $this->render('login.html.twig', ['error' => 'Le couple email / mot de passe est incorrect.', 'post' => $_POST]);
            }

            // On stocke les infos du user en session
            $_SESSION['user'] = $user_data;

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
     *
     * @return void
     */
    public function confirmAccount(string $id, string $token)
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
     *
     * @return void
     */
    public function logout()
    {
        if (!isset($_SESSION['user'])) {
            return $this->redirect('/');
        }

        unset($_SESSION['user']);

        return $this->redirect('/');
    }
}
