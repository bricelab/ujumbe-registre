<?php
/**
 * @author bricelab <bricehessou@gmail.com>
 * @version 0.1
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait TimestampTrait
{
    /**
     * @var \DateTimeInterface Date of creation
     * 
     * @ORM\Column(type="datetimetz")
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface Date of update
     * 
     * @ORM\Column(type="datetimetz")
     */
    protected $updatedAt;

    /**
     * Get date of creation
     *
     * @return  \DateTimeInterface
     */ 
    public function getCreatedAt() : ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set date of creation
     *
     * @param  \DateTimeInterface  $createdAt  Date of creation
     *
     * @return  self
     */ 
    public function setCreatedAt(\DateTimeInterface $createdAt) : self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get date of update
     *
     * @return  \DateTimeInterface
     */ 
    public function getUpdatedAt() : ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set date of update
     *
     * @param  \DateTimeInterface  $updatedAt  Date of update
     *
     * @return  self
     */ 
    public function setUpdatedAt(\DateTimeInterface $updatedAt) : self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

  
    /**
     * setCreatedAtValue
     *
     * @return void
     * 
     * @ORM\PrePersist
     */
    public function setCreatedAtValue() : void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * setUpdatedAtValue
     *
     * @return void
     * 
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue() : void
    {
        $this->updatedAt = new \DateTime();
    }

}