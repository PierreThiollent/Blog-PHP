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
        $sql = 'SELECT * from user WHERE email = :email';

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
        $sql = 'INSERT INTO user (firstname, lastname, email, password, role, confirmationToken) 
                VALUES (:firstname, :lastname, :email, :password, :role, :confirmationToken)';

        $this->DAL->execute($sql, [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'confirmationToken' => $user->getConfirmationToken(),
            'role' => $user->getRole(),
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
}
