<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CorrespondantRepository")
 * @ORM\Table(schema="gestion_registre")
 * @ORM\HasLifecycleCallbacks()
 */
class Correspondant
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
    private $nom_complet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CourrierArrive", mappedBy="sender")
     */
    private $listeCourriersEnvoyes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CourrierDepart", mappedBy="recipients", fetch="EXTRA_LAZY")
     */
    private $listeCourriersRecus;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Secretariat", inversedBy="correspondants", cascade={"persist", "remove", "merge"})
     */
    private $secretariats;

    public function __construct()
    {
        $this->listeCourriersEnvoyes = new ArrayCollection();
        $this->listeCourriersRecus = new ArrayCollection();
        $this->secretariats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nom_complet;
    }

    public function setNomComplet(string $nom_complet): self
    {
        $this->nom_complet = $nom_complet;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * @return Collection|CourrierArrive[]
     */
    public function getListeCourriersEnvoyes(): Collection
    {
        return $this->listeCourriersEnvoyes;
    }

    public function addListeCourriersEnvoye(CourrierArrive $listeCourriersEnvoye): self
    {
        if (!$this->listeCourriersEnvoyes->contains($listeCourriersEnvoye)) {
            $this->listeCourriersEnvoyes[] = $listeCourriersEnvoye;
            $listeCourriersEnvoye->setSender($this);
        }

        return $this;
    }

    public function removeListeCourriersEnvoye(CourrierArrive $listeCourriersEnvoye): self
    {
        if ($this->listeCourriersEnvoyes->contains($listeCourriersEnvoye)) {
            $this->listeCourriersEnvoyes->removeElement($listeCourriersEnvoye);
            // set the owning side to null (unless already changed)
            if ($listeCourriersEnvoye->getSender() === $this) {
                $listeCourriersEnvoye->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CourrierDepart[]
     */
    public function getListeCourriersRecus(): Collection
    {
        return $this->listeCourriersRecus;
    }

    public function addListeCourriersRecus(CourrierDepart $listeCourriersRecus): self
    {
        if (!$this->listeCourriersRecus->contains($listeCourriersRecus)) {
            $this->listeCourriersRecus[] = $listeCourriersRecus;
            $listeCourriersRecus->addRecipient($this);
        }

        return $this;
    }

    public function removeListeCourriersRecus(CourrierDepart $listeCourriersRecus): self
    {
        if ($this->listeCourriersRecus->contains($listeCourriersRecus)) {
            $this->listeCourriersRecus->removeElement($listeCourriersRecus);
            $listeCourriersRecus->removeRecipient($this);
        }

        return $this;
    }

    /**
     * @return Collection|Secretariat[]
     */
    public function getSecretariats(): Collection
    {
        return $this->secretariats;
    }

    public function addSecretariat(Secretariat $secretariat): self
    {
        if (!$this->secretariats->contains($secretariat)) {
            $this->secretariats[] = $secretariat;
        }

        return $this;
    }

    public function removeSecretariat(Secretariat $secretariat): self
    {
        if ($this->secretariats->contains($secretariat)) {
            $this->secretariats->removeElement($secretariat);
        }

        return $this;
    }
}
