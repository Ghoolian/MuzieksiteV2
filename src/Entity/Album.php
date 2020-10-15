<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="albums")
     */
    private $artist;

    /**
     * @ORM\OneToMany(targetEntity=Number::class, mappedBy="Album")
     */
    private $numbers;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Albumhoes;

    public function __construct()
    {
        $this->numbers = new ArrayCollection();
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

    public function getArtist(): ?artist
    {
        return $this->artist;
    }

    public function setArtist(?artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return Collection|Number[]
     */
    public function getNumber(): Collection
    {
        return $this->numbers;
    }

    public function addNumber(Number $number): self
    {
        if ($this->numbers->contains($number)) {
            $this->numbers->removeElement($number);
            // set the owning side to null (unless already changed)
            if ($number->getAlbum() === $this) {
                $number->setAlbum(null);
            }
        }

        return $this;
    }

    public function removeNumber(Number $numbers): self
    {
        if ($this->numbers->contains($numbers)) {
            $this->numbers->removeElement($numbers);
            // set the owning side to null (unless already changed)
            if ($numbers->getAlbum() === $this) {
                $numbers->setAlbum(null);
            }
        }

        return $this;
    }


    public function getAlbumhoes(): ?string
    {
        return $this->Albumhoes;
    }

    public function setAlbumhoes(string $Albumhoes): self
    {
        $this->Albumhoes = $Albumhoes;

        return $this;
    }
}
