<?php

namespace App;

class DockBlockReader
{
    /**
     * Method to parse validation constraints into dock blocks of entity properties
     *
     * @param  object $entity
     * @return array  $constraints
     */
    public function parseValidationConstraints(object $entity): array
    {
        $constraints = [];

        $object = new \ReflectionClass($entity);
        $properties = $object->getProperties();

        foreach ($properties as $property) {
            $comment = $property->getDocComment();

            if (preg_match_all('/@(Validate)\\\\([a-zA-Z]+)/m', $comment, $matches)) {
                $constraints[$property->getName()] = $matches[2];
            }
        }

        return $constraints;
    }
}
