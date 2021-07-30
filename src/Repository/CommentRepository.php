<?php

namespace App\Repository;

use App\DAL;
use App\Entity\Comment;
use App\Entity\User;
use App\Hydrator;

class CommentRepository
{
    private DAL $DAL;
    private Hydrator $hydrator;

    public function __construct()
    {
        $this->DAL = new DAL();
        $this->hydrator = new Hydrator();
    }

    /**
     * Method to add new comment.
     */
    public function add(Comment $comment): bool
    {
        $sql = 'INSERT INTO comment (content, authorId, articleId) 
                  VALUES (:content, :authorId, :articleId)';

        return $this->DAL->execute($sql, [
            'content'   => $comment->getContent(),
            'authorId'  => $comment->getAuthor()->getId(),
            'articleId' => $comment->getArticleId(),
        ]);
    }

    /**
     * Get all published comments.
     */
    public function getAll(array $order = []): array
    {
        $sql = 'SELECT comment.id, content, publishedAt, isValidated, authorId, articleId, firstname, lastname
                FROM comment INNER JOIN user ON comment.authorId = user.id';

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

        $this->DAL->execute($sql);
        $data = $this->DAL->fetchData('all');

        $comments = [];

        foreach ($data as &$comment) {
            $user = new User();
            $this->hydrator->hydrate($user, $comment);

            $comment['author'] = $user;

            $comment_object = new Comment();
            $this->hydrator->hydrate($comment_object, $comment);

            $comments[] = $comment_object;
        }

        return $comments;
    }

    /**
     * Validate a comment.
     */
    public function validate(int $id): bool
    {
        $sql = 'UPDATE comment SET isValidated = 1 WHERE id = :id';

        return $this->DAL->execute($sql, ['id' => $id]);
    }

    /**
     * Get comments of one article.
     */
    public function getArticleComments(int $articleId): array
    {
        $sql = 'SELECT comment.id, content, publishedAt, isValidated, authorId, articleId, firstname, lastname, imageUrl
                FROM comment INNER JOIN user ON comment.authorId = user.id WHERE articleId = :articleId';

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

        $this->DAL->execute($sql, ['articleId' => $articleId]);
        $data = $this->DAL->fetchData('all');

        $comments = [];

        foreach ($data as &$comment) {
            $user = new User();
            $this->hydrator->hydrate($user, $comment);

            $comment['author'] = $user;

            $comment_object = new Comment();
            $this->hydrator->hydrate($comment_object, $comment);

            $comments[] = $comment_object;
        }

        return $comments;
    }

    /**
     * Delete comment.
     */
    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM comment WHERE id = :id';

        return $this->DAL->execute($sql, ['id' => $id]);
    }
}
