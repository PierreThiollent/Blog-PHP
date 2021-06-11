<?php

namespace App\Controller;

use App\Entity\User;
use App\Helpers;
use App\Hydrator;
use App\Repository\UserRepository;
use App\Validator;

class SecurityController extends AbstractController
{
    private UserRepository $repository;
    private Hydrator $hydrator;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->hydrator = new Hydrator();
    }

    /**
     * Register new user
     *
     * @route /inscription
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
                    'error' => 'Un utilisateur avec cet email existe déjà. Vous pouvez vous <a href="/connexion">connecter</a> ou réinitialiser votre mot de passe si vous l\'avez oublié.'
                ]);
            }

            $user_id = $this->repository->addUser($user);

            if ($user_id) {
                $user->setId($user_id);

                mail(
                    $user->getEmail(),
                    'Confirmation de votre compte',
                    "Pour confirmer cotre compte, veuillez cliquer sur le lien suivant.\nhttps://blog-php.pierre-thiollent.fr/confirmation/$user_id-$token"
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
     * Confirm account
     *
     * @route /confirmation/:id-:token
     * @method GET
     * @return void
     */
    public function confirmAccount(string $id, string $token)
    {
        if (!$this->repository->confirmUser($id, $token)) {
            return $this->render(
                'register.html.twig',
                ['error' => 'Une erreur s\'est produite lors de la validation de votre compte. Veuillez réessayer.']
            );
        };

        $this->redirect('/connexion');
    }
}
