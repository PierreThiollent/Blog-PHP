<?php

namespace App\Entity;

class Comment
{
    private int $id;
    
    /**
     * @Validate\isNotEmpty
     */
    private string $content;

    private \DateTime $publishedAt;
    private int $isValidated;
    private User $author;
    private int $articleId;
    
    /**
     * Get the value of id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $name
     * @return  self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of publishedAt
     *
     * @return \DateTime|null
     */
    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @param \DateTime $publishedAt
     * @return  self
     */
    public function setPublishedAt(\DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get the value of isValidated
     *
     * @return int|null
     */
    public function getIsValidated(): ?int
    {
        return $this->isValidated;
    }

    /**
     * Set the value of isValidated
     *
     * @param int $isValidated
     * @return  self
     */
    public function setIsValidated(int $isValidated): self
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param User $author
     * @return  self
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of articleId
     *
     * @return int|null
     */
    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    /**
     * Set the value of articleId
     *
     * @param int $articleId
     * @return  self
     */
    public function setArticleId(int $articleId): self
    {
        $this->articleId = $articleId;

        return $this;
    }
}
