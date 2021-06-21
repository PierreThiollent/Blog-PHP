<?php

namespace App\Entity;

class Category
{
    private int $id;
    private string $name;
    private string $categorySlug;

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
     * Get name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->categorySlug;
    }

    /**
     * Set slug.
     *
     * @param  string $slug
     * @return self
     */
    public function setSlug(string $categorySlug): self
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }
}
