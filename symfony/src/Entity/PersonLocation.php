<?php

namespace App\Entity;

use App\Repository\PersonLocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonLocationRepository::class)
 */
class PersonLocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="visitedLocations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="peopleWhoVisited")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime")
     */
    private $visitedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getVisitedAt(): ?\DateTimeInterface
    {
        return $this->visitedAt;
    }

    public function setVisitedAt(\DateTimeInterface $visitedAt): self
    {
        $this->visitedAt = $visitedAt;

        return $this;
    }
}
