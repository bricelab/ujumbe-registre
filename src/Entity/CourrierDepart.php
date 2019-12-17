<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourrierDepartRepository")
 * @ORM\Table(schema="gestion_registre")
 * @ORM\HasLifecycleCallbacks()
 */
class CourrierDepart
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
    private $send_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Correspondant", inversedBy="listeCourriersRecus", cascade={"persist", "remove", "merge"})
     * @ORM\JoinTable(name="destinataires_courrier_depart", schema="gestion_registre")
     */
    private $recipients;

    public function __construct()
    {
        $this->recipients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSendAt(): ?\DateTimeInterface
    {
        return $this->send_at;
    }

    public function setSendAt(\DateTimeInterface $send_at): self
    {
        $this->send_at = $send_at;

        return $this;
    }

    /**
     * @return Collection|Correspondant[]
     */
    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function addRecipient(Correspondant $recipient): self
    {
        if (!$this->recipients->contains($recipient)) {
            $this->recipients[] = $recipient;
        }

        return $this;
    }

    public function removeRecipient(Correspondant $recipient): self
    {
        if ($this->recipients->contains($recipient)) {
            $this->recipients->removeElement($recipient);
        }

        return $this;
    }
}
