<?php

namespace App\Repository;

use App\Entity\Comment;
use App\DAL;

class CommentRepository
{
    private DAL $DAL;

    public function __construct()
    {
        $this->DAL = new DAL();
    }

    /**
     * Method to add new comment
     *
     * @param  Comment $comment
     * @return bool
     */
    public function add(Comment $comment): bool
    {
        $sql = 'INSERT INTO comment (content, authorId, articleId) 
                  VALUES (:content, :authorId, :articleId)';

        return $this->DAL->execute($sql, [
            'content' => $comment->getContent(),
            'authorId' => $comment->getAuthor()->getId(),
            'articleId' => $comment->getArticleId(),
        ]);
    }
}
