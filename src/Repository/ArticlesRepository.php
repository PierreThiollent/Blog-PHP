<?php

namespace App\Repository;

use App\Entity\Article;
use App\DAL;

class ArticlesRepository
{
    private DAL $DAL;

    public function __construct()
    {
        $this->DAL = new DAL();
    }

    /**
     * Get all articles
     *
     * @return Article[]
     */
    public function getAll(): array
    {
        $sql = 'SELECT * FROM article';
        $this->DAL->execute($sql);

        $data = $this->DAL->fetchData('all');

        foreach ($data as $article) {
            $article_object = new Article();

            $article_object->setId($article['id']);
            $article_object->setTitle($article['title']);
            $article_object->setExcerpt($article['excerpt']);
            $article_object->setContent($article['content']);
            $article_object->setAuthorId($article['authorId']);
            $article_object->setSlug($article['slug']);
            $article_object->setPublishedDate(new \DateTime($article['publishedDate']));
            $article_object->setUpdatedDate(new \DateTime($article['updatedDate']));
            $article_object->setThumbnailUrl($article['thumbnailUrl']);

            $articles[] = $article_object;
        }

        return $articles;
    }
}
