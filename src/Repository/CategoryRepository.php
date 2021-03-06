<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Category;
use App\Hydrator;

class CategoryRepository
{
    private DAL $DAL;
    private Hydrator $hydrator;

    public function __construct()
    {
        $this->DAL = new DAL();
        $this->hydrator = new Hydrator();
    }

    /**
     * Get category by id
     *
     * @param  int      $id
     * @return Category
     */
    public function getById(int $id): Category
    {
        $sql = "SELECT * FROM category WHERE id = $id";

        $this->DAL->execute($sql);

        $data = $this->DAL->fetchData();

        $category = new Category();
        $this->hydrator->hydrate($category, $data);

        return $category;
    }

    /**
     * Get all categories
     *
     * @return Category[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM category";

        $this->DAL->execute($sql);

        $data = $this->DAL->fetchData('all');

        foreach ($data as $category) {
            $categoryObject = new Category();
            $this->hydrator->hydrate($categoryObject, $category);

            $categories[] = $categoryObject;
        }

        return $categories;
    }
}
