<?php

namespace App\Entity\Authentication;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Authentication\UserRepository")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_super;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authentication\Cluster", inversedBy="users")
     */
    private $clusters;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Authentication\PasswordRecovery", mappedBy="user", orphanRemoval=true)
     */
    private $passwordRecoveries;


    public function __construct()
    {
        $this->is_super = false;
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
        $this->is_super = false;
        $this->clusters = new ArrayCollection();
        $this->passwordRecoveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        if(false == empty($password)) {
            $this->password = $password;
        }

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getIsSuper(): ?bool
    {
        return $this->is_super;
    }

    public function setIsSuper(?bool $is_super): self
    {
        $this->is_super = $is_super;

        return $this;
    }

    /**
     * @return Collection|Cluster[]
     */
    public function getClusters(): Collection
    {
        return $this->clusters;
    }

    public function addCluster(Cluster $cluster): self
    {
        if (!$this->clusters->contains($cluster)) {
            $this->clusters[] = $cluster;
        }

        return $this;
    }

    public function removeCluster(Cluster $cluster): self
    {
        if ($this->clusters->contains($cluster)) {
            $this->clusters->removeElement($cluster);
        }

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roles = ['ROLE_USER'];

        if($this->is_super) {
            $roles[] = 'ROLE_ADMIN';
        }

        return $roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getName();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    /**
     * @return Collection|PasswordRecovery[]
     */
    public function getPasswordRecoveries(): Collection
    {
        return $this->passwordRecoveries;
    }

    public function addPasswordRecovery(PasswordRecovery $passwordRecovery): self
    {
        if (!$this->passwordRecoveries->contains($passwordRecovery)) {
            $this->passwordRecoveries[] = $passwordRecovery;
            $passwordRecovery->setUser($this);
        }

        return $this;
    }

    public function removePasswordRecovery(PasswordRecovery $passwordRecovery): self
    {
        if ($this->passwordRecoveries->contains($passwordRecovery)) {
            $this->passwordRecoveries->removeElement($passwordRecovery);
            // set the owning side to null (unless already changed)
            if ($passwordRecovery->getUser() === $this) {
                $passwordRecovery->setUser(null);
            }
        }

        return $this;
    }



}
