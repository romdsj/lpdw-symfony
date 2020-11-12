<?php

namespace App\Entity;

use App\Repository\PersonCovidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonCovidRepository::class)
 */
class PersonCovid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="hasCovid", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $detectedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDetectedAt(): ?\DateTimeInterface
    {
        return $this->detectedAt;
    }

    public function setDetectedAt(\DateTimeInterface $detectedAt): self
    {
        $this->detectedAt = $detectedAt;

        return $this;
    }
}
