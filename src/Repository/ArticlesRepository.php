<?php

namespace App\Repository;

use App\Entity\Article;
use App\DAL;
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
        $sql = 'SELECT * FROM article';

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

        foreach ($data as $article) {
            $article_object = new Article();
            $this->hydrator->hydrate($article_object, $article);
            $articles[] = $article_object;
        }

        return $articles;
    }

    public function getOne(int $id): ?Article
    {
        $sql = "SELECT * FROM article WHERE id = $id";

        $this->DAL->execute($sql);

        $data = $this->DAL->fetchData();

        if ($data) {
            $article = new Article();
            $this->hydrator->hydrate($article, $data);

            return $article;
        }

        return null;
    }
}
