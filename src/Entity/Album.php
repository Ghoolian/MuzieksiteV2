<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=artist::class, inversedBy="albums")
     */
    private $artist;

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

    public function getArtist(): ?artist
    {
        return $this->artist;
    }

    public function setArtist(?artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
