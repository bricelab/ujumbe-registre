<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourrierArriveRepository")
 * @ORM\Table(schema="gestion_registre")
 * @ORM\HasLifecycleCallbacks()
 */
class CourrierArrive
{
    use TimestampTrait;
    use CourrierTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="date")
     */
    private $received_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sender", inversedBy="listeCourriersEnvoyes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReceivedAt(): ?\DateTimeInterface
    {
        return $this->received_at;
    }

    public function setReceivedAt(\DateTimeInterface $received_at): self
    {
        $this->received_at = $received_at;

        return $this;
    }

    public function getSender(): ?Correspondant
    {
        return $this->sender;
    }

    public function setSender(?Correspondant $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
