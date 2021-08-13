<?php

namespace App\Repository;

use App\DAL;
use App\Entity\User;
use App\Hydrator;

class UserRepository
{
    private DAL $DAL;
    private Hydrator $hydrator;

    public function __construct()
    {
        $this->DAL = new Dal();
        $this->hydrator = new Hydrator();
    }

    /**
     * Method to get one user by email.
     *
     * @return bool|User
     */
    public function userExist(User $user): bool | User
    {
        $sql = 'SELECT id, email, firstname, lastname, role, imageUrl from user WHERE email = :email';

        $this->DAL->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->DAL->fetchData('all');

        if (empty($data)) {
            return false;
        }

        $user_object = new User();
        $this->hydrator->hydrate($user_object, $data[0]);

        return $user_object;
    }

    /**
     * Method to create new user.
     *
     * @return string|bool
     */
    public function addUser(User $user): string | bool
    {
        $sql = 'INSERT INTO user (firstname, lastname, email, password, role, confirmationToken, imageUrl) 
                VALUES (:firstname, :lastname, :email, :password, :role, :confirmationToken, :imageUrl)';

        $this->DAL->execute($sql, [
            'firstname'         => $user->getFirstname(),
            'lastname'          => $user->getLastname(),
            'email'             => $user->getEmail(),
            'password'          => $user->getPassword(),
            'role'              => $user->getRole(),
            'confirmationToken' => $user->getConfirmationToken(),
            'imageUrl'          => $user->getImageUrl(),
        ]);

        return $this->DAL->lastInsertId();
    }

    /**
     * Method to confirm user account.
     */
    public function confirmUser(string $user_id, string $token): bool
    {
        $sql = 'UPDATE user SET confirmationToken = NULL, confirmedAt = NOW() 
                WHERE id = :id AND confirmationToken = :confirmationToken';

        return $this->DAL->execute($sql, ['id' => $user_id, 'confirmationToken' => $token]);
    }

    /**
     * Method to update user account.
     */
    public function updateUser(User $user): bool
    {
        $sql = 'UPDATE user SET firstname = :firstname, lastname = :lastname, password = :password
                WHERE id = :id AND email = :email';

        return $this->DAL->execute($sql, [
            'firstname' => $user->getFirstname(),
            'lastname'  => $user->getLastname(),
            'password'  => $user->getPassword(),
            'id'        => $user->getId(),
            'email'     => $user->getEmail(),
        ]);
    }

    /**
     * Check if user account is confirmed.
     */
    public function checkConfirmUser(User $user): bool
    {
        $sql = 'SELECT confirmationToken, confirmedAt from user WHERE email = :email';

        $this->DAL->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->DAL->fetchData('all');

        if ($data[0]['confirmationToken'] !== null && $data[0]['confirmedAt'] === null) {
            return false;
        }

        return true;
    }

    /**
     * Check if password entered by user is correct.
     */
    public function getUserPasswordHash(User $user): string
    {
        $sql = 'SELECT password from user WHERE email = :email';

        $this->DAL->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->DAL->fetchData('all');

        return $data[0]['password'];
    }
}
