<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Article;
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
     * Get all articles.
     *
     * @return Article[]
     */
    public function getAll(array $order = [], ?int $limit = null): array
    {
        $sql = 'SELECT article.id, title, excerpt, content, article.slug, publishedDate, updatedDate, thumbnailUrl, name, firstname, lastname, imageUrl 
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
                ++$i;
            }
        }

        if (isset($limit)) {
            $sql .= " LIMIT $limit";
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

        return $articles;
    }

    public function getOne(int $id): ?Article
    {
        $sql = "SELECT article.id, title, excerpt, content, article.slug, publishedDate, updatedDate, thumbnailUrl, firstname, lastname, imageUrl, name, trending
                FROM article 
                INNER JOIN category ON article.categoryId = category.id 
                INNER JOIN user ON article.authorId = user.id WHERE article.id = $id";

        $this->DAL->execute($sql);
        $data = $this->DAL->fetchData();

        if ($data) {
            $category = new Category();
            $this->hydrator->hydrate($category, $data);

            $data['category'] = $category;

            $user = new User();
            $this->hydrator->hydrate($user, $data);

            $data['author'] = $user;

            $article = new Article();
            $this->hydrator->hydrate($article, $data);

            return $article;
        }

        return null;
    }

    /**
     * Get trending articles.
     *
     * @return array Article[]
     */
    public function getTrending(array $order = [], ?int $limit = null): array
    {
        $sql = 'SELECT article.id, title, excerpt, content, article.slug, publishedDate, updatedDate, thumbnailUrl, name, firstname, lastname, imageUrl 
                FROM article 
                INNER JOIN category ON article.categoryId = category.id 
                INNER JOIN user ON article.authorId = user.id
                WHERE article.trending = 1';

        if (!empty($order)) {
            $sql .= ' ORDER BY ';

            $i = 0;
            foreach ($order as $columnName => $sens) {
                if ($i === 0) {
                    $sql .= "$columnName $sens";
                } else {
                    $sql .= ", $columnName $sens";
                }
                ++$i;
            }
        }

        if (isset($limit)) {
            $sql .= " LIMIT $limit";
        }

        $this->DAL->execute($sql);
        $data = $this->DAL->fetchData('all');

        $articles = [];

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

        return $articles;
    }

    /**
     * Get articles by category id.
     */
    public function getArticlesByCategory(int $category, array $order = [], ?int $limit = null): array
    {
        $sql = "SELECT article.id, title, excerpt, content, article.slug, publishedDate,
                updatedDate, thumbnailUrl, name, firstname, lastname, imageUrl 
                FROM article 
                INNER JOIN category ON article.categoryId = category.id 
                INNER JOIN user ON article.authorId = user.id
                WHERE article.categoryId = $category";

        if (!empty($order)) {
            $sql .= ' ORDER BY ';

            $i = 0;
            foreach ($order as $columnName => $sens) {
                if ($i === 0) {
                    $sql .= "$columnName $sens";
                } else {
                    $sql .= ", $columnName $sens";
                }
                ++$i;
            }
        }

        if (isset($limit)) {
            $sql .= " LIMIT $limit";
        }

        $this->DAL->execute($sql);
        $data = $this->DAL->fetchData('all');

        $articles = [];
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

        return $articles;
    }

    /**
     * Add new article.
     */
    public function add(Article $article): bool
    {
        $sql = 'INSERT INTO article (title, excerpt, content, authorId, slug, thumbnailUrl, categoryId, trending) 
                VALUES (:title, :excerpt, :content, :authorId, :slug, :thumbnailUrl, :categoryId, :trending)';

        return $this->DAL->execute($sql, [
            'title'        => $article->getTitle(),
            'excerpt'      => $article->getExcerpt(),
            'content'      => $article->getContent(),
            'authorId'     => $article->getAuthor()->getId(),
            'slug'         => $article->getSlug(),
            'thumbnailUrl' => $article->getThumbnailUrl(),
            'categoryId'   => $article->getCategory()->getId(),
            'trending'     => $article->getTrending(),
        ]);
    }

    public function update(Article $article): bool
    {
        $sql = 'UPDATE article SET title = :title, excerpt = :excerpt, content = :content, authorId = :authorId, slug = :slug, thumbnailUrl = :thumbnailUrl, categoryId = :categoryId, trending = :trending WHERE id = :id';

        return $this->DAL->execute($sql, [
            'title'        => $article->getTitle(),
            'excerpt'      => $article->getExcerpt(),
            'content'      => $article->getContent(),
            'authorId'     => $article->getAuthor()->getId(),
            'slug'         => $article->getSlug(),
            'thumbnailUrl' => $article->getThumbnailUrl(),
            'categoryId'   => $article->getCategory()->getId(),
            'trending'     => $article->getTrending(),
            'id'           => $article->getId(),
        ]);
    }

    /**
     * Delete one article by id.
     */
    public function delete(int $articleId): bool
    {
        $sql = 'DELETE FROM article WHERE id = :id';

        return $this->DAL->execute($sql, ['id' => $articleId]);
    }
}
