<?php

namespace App\Entity;

class Article
{
    private int $id;

    /**
     * @Validate\isNotEmpty
     */
    private string $title;

    /**
     * @Validate\isNotEmpty
     */
    private string $excerpt;

    /**
     * @Validate\isNotEmpty
     */
    private string $content;
    private User $author;
    private string $slug;
    private \DateTime $publishedDate;
    private \DateTime $updatedDate;
    private string $thumbnailUrl;

    /**
     * @Validate\isNotEmpty
     */
    private Category $category;
    private int $trending;

    /**
     * Getter id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Setter id.
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get title.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set title.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get excerpt.
     */
    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    /**
     * Set excerpt.
     */
    public function setExcerpt(string $excerpt): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get content.
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content.
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get author.
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * Set author.
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get slug.
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug.
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get published date.
     */
    public function getPublishedDate(): ?\DateTime
    {
        return $this->publishedDate;
    }

    /**
     * Set published date.
     *
     * @param \DateTime $published_date
     */
    public function setPublishedDate(\DateTime $publishedDate): self
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }

    /**
     * Get updated date.
     */
    public function getUpdatedDate(): ?\DateTime
    {
        return $this->updatedDate;
    }

    /**
     * Set updated date.
     */
    public function setUpdatedDate(\DateTime $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get thumbnail url.
     */
    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    /**
     * Set thumbnail url.
     */
    public function setThumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Get category.
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Set category.
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of trending.
     */
    public function getTrending(): int
    {
        return $this->trending;
    }

    /**
     * Set the value of trending.
     */
    public function setTrending(int $trending): self
    {
        $this->trending = $trending;

        return $this;
    }
}
