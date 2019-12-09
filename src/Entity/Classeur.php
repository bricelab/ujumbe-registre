<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseurRepository")
 * @ORM\Table(schema="gestion_registre")
 * @ORM\HasLifecycleCallbacks()
 */
class Classeur
{
    use TimestampTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CourrierArrive", mappedBy="classeur")
     */
    private $listeCourriersArrives;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CourrierDepart", mappedBy="classeur")
     */
    private $listeCourriersDeparts;

    public function __construct()
    {
        $this->listeCourriersArrives = new ArrayCollection();
        $this->listeCourriersDeparts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
     * @return Collection|CourrierArrive[]
     */
    public function getListeCourriersArrives(): Collection
    {
        return $this->listeCourriersArrives;
    }

    public function addListeCourriersArrife(CourrierArrive $listeCourriersArrife): self
    {
        if (!$this->listeCourriersArrives->contains($listeCourriersArrife)) {
            $this->listeCourriersArrives[] = $listeCourriersArrife;
            $listeCourriersArrife->setClasseur($this);
        }

        return $this;
    }

    public function removeListeCourriersArrife(CourrierArrive $listeCourriersArrife): self
    {
        if ($this->listeCourriersArrives->contains($listeCourriersArrife)) {
            $this->listeCourriersArrives->removeElement($listeCourriersArrife);
            // set the owning side to null (unless already changed)
            if ($listeCourriersArrife->getClasseur() === $this) {
                $listeCourriersArrife->setClasseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CourrierDepart[]
     */
    public function getListeCourriersDeparts(): Collection
    {
        return $this->listeCourriersDeparts;
    }

    public function addListeCourriersDepart(CourrierDepart $listeCourriersDepart): self
    {
        if (!$this->listeCourriersDeparts->contains($listeCourriersDepart)) {
            $this->listeCourriersDeparts[] = $listeCourriersDepart;
            $listeCourriersDepart->setClasseur($this);
        }

        return $this;
    }

    public function removeListeCourriersDepart(CourrierDepart $listeCourriersDepart): self
    {
        if ($this->listeCourriersDeparts->contains($listeCourriersDepart)) {
            $this->listeCourriersDeparts->removeElement($listeCourriersDepart);
            // set the owning side to null (unless already changed)
            if ($listeCourriersDepart->getClasseur() === $this) {
                $listeCourriersDepart->setClasseur(null);
            }
        }

        return $this;
    }
}