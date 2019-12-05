<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecretariatRepository")
 * @ORM\Table(schema="gestion_registre")
 * @ORM\HasLifecycleCallbacks()
 */
class Secretariat
{
    use TimestampTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sigle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registre", mappedBy="secretariat")
     */
    private $listeRegistres;

    public function __construct()
    {
        $this->listeRegistres = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->nom . "(" . $this->sigle . ")";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Registre[]
     */
    public function getListeRegistres(): Collection
    {
        return $this->listeRegistres;
    }

    public function addListeRegistre(Registre $listeRegistre): self
    {
        if (!$this->listeRegistres->contains($listeRegistre)) {
            $this->listeRegistres[] = $listeRegistre;
            $listeRegistre->setSecretariat($this);
        }

        return $this;
    }

    public function removeListeRegistre(Registre $listeRegistre): self
    {
        if ($this->listeRegistres->contains($listeRegistre)) {
            $this->listeRegistres->removeElement($listeRegistre);
            // set the owning side to null (unless already changed)
            if ($listeRegistre->getSecretariat() === $this) {
                $listeRegistre->setSecretariat(null);
            }
        }

        return $this;
    }
}