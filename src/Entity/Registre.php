<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistreRepository")
 * @ORM\Table(schema="gestion_registre")
 * @ORM\HasLifecycleCallbacks()
 */
class Registre
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
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretariat", inversedBy="listeRegistres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secretariat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRegistre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CourrierArrive", mappedBy="registre")
     */
    private $listeCourriersArrives;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CourrierDepart", mappedBy="registre")
     */
    private $listeCourriersDeparts;

    public function __construct()
    {
        $this->listeCourriersArrives = new ArrayCollection();
        $this->listeCourriersDeparts = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSecretariat(): ?Secretariat
    {
        return $this->secretariat;
    }

    public function setSecretariat(?Secretariat $secretariat): self
    {
        $this->secretariat = $secretariat;

        return $this;
    }

    public function getType(): ?TypeRegistre
    {
        return $this->type;
    }

    public function setType(?TypeRegistre $type): self
    {
        $this->type = $type;

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
            $listeCourriersArrife->setRegistre($this);
        }

        return $this;
    }

    public function removeListeCourriersArrife(CourrierArrive $listeCourriersArrife): self
    {
        if ($this->listeCourriersArrives->contains($listeCourriersArrife)) {
            $this->listeCourriersArrives->removeElement($listeCourriersArrife);
            // set the owning side to null (unless already changed)
            if ($listeCourriersArrife->getRegistre() === $this) {
                $listeCourriersArrife->setRegistre(null);
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
            $listeCourriersDepart->setRegistre($this);
        }

        return $this;
    }

    public function removeListeCourriersDepart(CourrierDepart $listeCourriersDepart): self
    {
        if ($this->listeCourriersDeparts->contains($listeCourriersDepart)) {
            $this->listeCourriersDeparts->removeElement($listeCourriersDepart);
            // set the owning side to null (unless already changed)
            if ($listeCourriersDepart->getRegistre() === $this) {
                $listeCourriersDepart->setRegistre(null);
            }
        }

        return $this;
    }
}
