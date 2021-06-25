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
     * Method to get one user by email
     *
     * @param  User $user
     * @return bool|User
     */
    public function userExist(User $user): bool|User
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
     * Method to create new user
     *
     * @param  User $user
     * @return string|bool
     */
    public function addUser(User $user): string|bool
    {
        $sql = 'INSERT INTO user (firstname, lastname, email, password, role, confirmationToken, imageUrl) 
                VALUES (:firstname, :lastname, :email, :password, :role, :confirmationToken, :imageUrl)';

        $this->DAL->execute($sql, [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole(),
            'confirmationToken' => $user->getConfirmationToken(),
            'imageUrl' => $user->getImageUrl(),
        ]);

        return $this->DAL->lastInsertId();
    }

    /**
     * Method to confirm user account
     * 
     * @param string $user_id
     * @param string $token
     * @return bool
     */
    public function confirmUser(string $user_id, string $token): bool
    {
        $sql = 'UPDATE user SET confirmationToken = NULL, confirmedAt = NOW() 
                WHERE id = :id AND confirmationToken = :confirmationToken';

        return $this->DAL->execute($sql, ['id'=> $user_id, 'confirmationToken' => $token]);
    }

    /**
     * Method to update user account
     * 
     * @param User $user
     * @return bool
     */
    public function updateUser(User $user): bool
    {
        $sql = 'UPDATE user SET firstname = :firstname, lastname = :lastname, password = :password
                WHERE email = :email';

        return $this->DAL->execute($sql, [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
        ]);
    }

    /**
     * Check if user account is confirmed
     * 
     * @param User $user
     * @return bool
     */
    public function checkConfirmUser(User $user): bool
    {
        $sql = 'SELECT confirmationToken, confirmedAt from user WHERE email = :email';

        $this->DAL->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->DAL->fetchData('all');

        if (!is_null($data[0]['confirmationToken']) && is_null($data[0]['confirmedAt'])) {
            return false;
        }

        return true;
    }


    /**
     * Check if password entered by user is correct
     * 
     * @param User $user
     * @return string
     */
    public function getUserPasswordHash(User $user): string
    {
        $sql = 'SELECT password from user WHERE email = :email';

        $this->DAL->execute($sql, ['email' => $user->getEmail()]);
        $data = $this->DAL->fetchData('all');

        return $data[0]['password'];
    }
}
