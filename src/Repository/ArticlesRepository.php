<?php

namespace App\Repository;

use App\Entity\Article;
use App\DAL;
use App\Entity\Category;
use App\Hydrator;

class ArticlesRepository
{
    private DAL $DAL;
    private Hydrator $hydrator;

    public function __construct()
    {
        $this->DAL = new DAL();
        $this->hydrator = new Hydrator();
    }

    /**
     * Get all articles
     * @param  array     $order
     * @return Article[]
     */
    public function getAll(array $order = []): array
    {
        $sql = 'SELECT * FROM article INNER JOIN category ON article.categoryId = category.id';

        if (!empty($order)) {
            $sql .= ' ORDER BY ';

            $i = 0;
            foreach ($order as $columnName => $sens) {
                if ($i === 0) {
                    $sql .= "$columnName $sens";
                } else {
                    $sql .= ", $columnName $sens";
                }
                $i++;
            }
        }

        $this->DAL->execute($sql);
        $data = $this->DAL->fetchData('all');

        foreach ($data as &$article) {
            $category = new Category();
            $this->hydrator->hydrate($category, $article);

            $article['category'] = $category;

            $article_object = new Article();
            $this->hydrator->hydrate($article_object, $article);

            $articles[] = $article_object;
        }

        return $articles;
    }
}
