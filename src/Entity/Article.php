<?php

namespace App\Entity;

class Article
{
    private int $id;
    private string $title;
    private string $excerpt;
    private string $content;
    private int $authorId;
    private string $slug;
    private \DateTime $publishedDate;
    private \DateTime $updatedDate;
    private string $thumbnailUrl;
    private int $categoryId;

    /**
     * Getter id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter id
     *
     * @param  int  $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param  string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get excerpt.
     *
     * @return string|null
     */
    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    /**
     * Set excerpt.
     *
     * @param  string $excerpt
     * @return self
     */
    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content.
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get author id.
     *
     * @return int|null
     */
    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    /**
     * Set author id.
     *
     * @param  int  $authorId
     * @return self
     */
    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug.
     *
     * @param  string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get published date.
     *
     * @return \DateTime|null
     */
    public function getPublishedDate(): ?\DateTime
    {
        return $this->publishedDate;
    }

    /**
     * Set published date.
     *
     * @param  \DateTime $published_date
     * @return self
     */
    public function setPublishedDate(\DateTime $publishedDate): self
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }

    /**
     * Get updated date.
     *
     * @return \DateTime|null
     */
    public function getUpdatedDate(): ?\DateTime
    {
        return $this->updatedDate;
    }

    /**
     * Set updated date.
     *
     * @param  \DateTime $updatedDate
     * @return self
     */
    public function setUpdatedDate(\DateTime $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get thumbnail url.
     *
     * @return string|null
     */
    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    /**
     * Set thumbnail url.
     *
     * @param  string $thumbnailUrl
     * @return self
     */
    public function setThumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Get category id.
     *
     * @return string|null
     */
    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }

    /**
     * Set category id.
     *
     * @param  string $categoryId
     * @return self
     */
    public function setCategoryId(string $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }
}
