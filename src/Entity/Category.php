<?php

namespace App\Entity;

class Category
{
    private int $id;
    private string $name;

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
    public function setTitle(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
