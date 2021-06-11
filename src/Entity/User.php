<?php

namespace App\Entity;

class User
{
    private int $id;

    /**
     * @var string
     * @Validate\isNotEmpty
     */
    private string $firstname;

    /**
     * @var string
     * @Validate\isNotEmpty
     */
    private string $lastname;

    /**
     * @var string
     * @Validate\isNotEmpty
     */
    private string $email;

    /**
     * @var string
     * @Validate\isNotEmpty
     */
    private string $password;

    private string $confirmationToken;
    private \DateTime $confirmedAt;
    private string $role;

    public function __construct()
    {
        $this->role = 'user';
    }

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
     * Getter firstname
     *
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Setter firstname
     *
     * @param  string $firstname
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Getter lastname
     *
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Setter lastname
     *
     * @param  string $lastname
     * @return self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @param string|null $email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string|null $password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of confirmationToken
     *
     * @return string|null
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    /**
     * Set the value of confirmationToken
     *
     * @param  string $confirmationToken
     * @return self
     */
    public function setConfirmationToken(string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get the value of confirmedAt
     *
     * @return \DateTime|null
     */
    public function getConfirmedAt(): ?\DateTime
    {
        return $this->confirmedAt;
    }

    /**
     * Set the value of confirmedAt
     *
     * @param  \DateTime $confirmedAt
     * @return self
     */
    public function setConfirmedAt(\DateTime $confirmedAt): self
    {
        $this->confirmedAt = $confirmedAt;

        return $this;
    }

    /**
     * Get the value of role
     *
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  string $role
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
