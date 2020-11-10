<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity=PersonLocation::class, mappedBy="person", orphanRemoval=true)
     */
    private $visitedLocations;

    public function __construct()
    {
        $this->visitedLocations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection|PersonLocation[]
     */
    public function getVisitedLocations(): Collection
    {
        return $this->visitedLocations;
    }

    public function addVisitedLocation(PersonLocation $visitedLocation): self
    {
        if (!$this->visitedLocations->contains($visitedLocation)) {
            $this->visitedLocations[] = $visitedLocation;
            $visitedLocation->setPerson($this);
        }

        return $this;
    }

    public function removeVisitedLocation(PersonLocation $visitedLocation): self
    {
        if ($this->visitedLocations->removeElement($visitedLocation)) {
            // set the owning side to null (unless already changed)
            if ($visitedLocation->getPerson() === $this) {
                $visitedLocation->setPerson(null);
            }
        }

        return $this;
    }
}
