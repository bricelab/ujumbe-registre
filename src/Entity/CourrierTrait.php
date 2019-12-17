<?php
/**
 * @author bricelab <bricehessou@gmail.com>
 * @version 0.1
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait CourrierTrait
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chrono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="date")
     */
    private $courrier_date;

    /**
     * @ORM\Column(type="text")
     */
    private $objet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCourrier", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classeur", inversedBy="listeCourriersArrives", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $classeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Registre", inversedBy="listeCourriersArrives", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $registre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * getChrono
     *
     * @return int
     */
    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono(int $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCourrierDate(): ?\DateTimeInterface
    {
        return $this->courrier_date;
    }

    public function setCourrierDate(\DateTimeInterface $courrier_date): self
    {
        $this->courrier_date = $courrier_date;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getType(): ?TypeCourrier
    {
        return $this->type;
    }

    public function setType(?TypeCourrier $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getClasseur(): ?Classeur
    {
        return $this->classeur;
    }

    public function setClasseur(?Classeur $classeur): self
    {
        $this->classeur = $classeur;

        return $this;
    }

    public function getRegistre(): ?Registre
    {
        return $this->registre;
    }

    public function setRegistre(?Registre $registre): self
    {
        $this->registre = $registre;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

}