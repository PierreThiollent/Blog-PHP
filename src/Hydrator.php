<?php

namespace App;

class Hydrator
{
    private const DATES = ['publishedDate', 'updatedDate', 'confirmedAt'];

    /**
     * Method to hydrate entity
     *
     * @param  object $entity
     * @param  array  $data
     * @return void
     */
    public function hydrate(object $entity, array $data): void
    {
        foreach ($data as $key => &$value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($entity, $setter)) {
                if (in_array($key, self::DATES)) {
                    $value = new \DateTime($value);
                }
                $entity->$setter($value);
            }
        }
    }
}
