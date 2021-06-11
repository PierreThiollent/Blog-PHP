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
                    if (!is_null($this->$constraint($property_name, $data[$property_name]))) {
                        $errors[$property_name] = $this->$constraint($property_name, $data[$property_name]);
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
     * @param $value
     * @return string|void
     */
    public function isNotEmpty($value)
    {
        if ($value === '') {
            return 'Le champ ne doit pas être vide.';
        }
    }
}
