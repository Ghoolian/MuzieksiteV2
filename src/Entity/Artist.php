<?php

namespace App\Entity;

use App\Repository\ArtiestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtiestRepository::class)
 */
class Artist
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
    private $Naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Achternaam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Muziekstijl;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Geboortedatum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Beschrijving;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->Naam;
    }

    public function setNaam(string $Naam): self
    {
        $this->Naam = $Naam;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->Achternaam;
    }

    public function setAchternaam(string $Achternaam): self
    {
        $this->Achternaam = $Achternaam;

        return $this;
    }

    public function getMuziekstijl(): ?string
    {
        return $this->Muziekstijl;
    }

    public function setMuziekstijl(?string $Muziekstijl): self
    {
        $this->Muziekstijl = $Muziekstijl;

        return $this;
    }

    public function getGeboortedatum(): ?\DateTimeInterface
    {
        return $this->Geboortedatum;
    }

    public function setGeboortedatum(?\DateTimeInterface $Geboortedatum): self
    {
        $this->Geboortedatum = $Geboortedatum;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->Beschrijving;
    }

    public function setBeschrijving(?string $Beschrijving): self
    {
        $this->Beschrijving = $Beschrijving;

        return $this;
    }
}
