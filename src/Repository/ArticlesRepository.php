<?php

namespace App\Repository;

use App\Entity\Article;
use App\DAL;
use App\Entity\Category;
use App\Entity\User;
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
        $sql = 'SELECT article.id, title, excerpt, content, article.slug, publishedDate, updatedDate, thumbnailUrl, name, firstname, lastname 
                FROM article 
                INNER JOIN category ON article.categoryId = category.id 
                INNER JOIN user ON article.authorId = user.id';

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

            $user = new User();
            $this->hydrator->hydrate($user, $article);

            $article['author'] = $user;

            $article_object = new Article();
            $this->hydrator->hydrate($article_object, $article);

            $articles[] = $article_object;
        }
        dump($articles);

        return $articles;
    }

    public function getOne(int $id): ?Article
    {
        $sql = "SELECT article.id, title, excerpt, content, article.slug, publishedDate, updatedDate, thumbnailUrl, firstname, lastname 
                FROM article INNER JOIN user ON article.authorId = user.id WHERE article.id = $id";

        $this->DAL->execute($sql);
        $data = $this->DAL->fetchData();

        if ($data) {
            $user = new User();
            $this->hydrator->hydrate($user, $data);

            $data['author'] = $user;

            $article = new Article();
            $this->hydrator->hydrate($article, $data);

            dump($article);
            return $article;
        }

        return null;
    }
}
