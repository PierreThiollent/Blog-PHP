<?php

namespace App;

class Validator
{
    /**
     * Method to validate entity
     *
     * @param object $entity
     * @param array  $data
     */
    public function validate(object $entity, array $data): array
    {
        $errors = [];

        $dockBlockReader = new DockBlockReader();
        $validations = $dockBlockReader->parseValidationConstraints($entity);

        foreach ($validations as $property_name => $constraints) {
            foreach ($constraints as $constraint) {
                if (method_exists($this, $constraint)) {
                    if (!is_null($this->$constraint($data[$property_name]))) {
                        $errors[$property_name] = $this->$constraint($data[$property_name]);
                    }
                } else {
                    // TODO : Call logger or throw Exception
                }
            }
        }

        return $errors;
    }

    /**
     * Method to check if field is not empty
     *
     * @param  string      $value
     * @return string|void
     */
    public function isNotEmpty(string $value)
    {
        if ($value === '') {
            return 'Le champ ne doit pas être vide.';
        }
    }

    /**
     * Method to check if an email is valid
     *
     * @param  string      $email
     * @return string|void
     */
    public function isValidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "L'adresse email doit etre une adresse email valide.";
        }
    }

    /**
     * Method to check if a password is secure
     *
     * @param  string      $password
     * @return string|void
     */
    public function isSecurePassword(string $password)
    {
        if (!preg_match('/^(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/', $password)) {
            return 'Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, une minuscule et un chiffre.';
        }
    }
}
