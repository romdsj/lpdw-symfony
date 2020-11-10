<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxNumberOfPersons;

    /**
     * @ORM\OneToMany(targetEntity=PersonLocation::class, mappedBy="location", orphanRemoval=true)
     */
    private $peopleWhoVisited;

    public function __construct()
    {
        $this->peopleWhoVisited = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMaxNumberOfPersons(): ?int
    {
        return $this->maxNumberOfPersons;
    }

    public function setMaxNumberOfPersons(int $maxNumberOfPersons): self
    {
        $this->maxNumberOfPersons = $maxNumberOfPersons;

        return $this;
    }

    /**
     * @return Collection|PersonLocation[]
     */
    public function getPeopleWhoVisited(): Collection
    {
        return $this->peopleWhoVisited;
    }

    public function addPeopleWhoVisited(PersonLocation $peopleWhoVisited): self
    {
        if (!$this->peopleWhoVisited->contains($peopleWhoVisited)) {
            $this->peopleWhoVisited[] = $peopleWhoVisited;
            $peopleWhoVisited->setLocation($this);
        }

        return $this;
    }

    public function removePeopleWhoVisited(PersonLocation $peopleWhoVisited): self
    {
        if ($this->peopleWhoVisited->removeElement($peopleWhoVisited)) {
            // set the owning side to null (unless already changed)
            if ($peopleWhoVisited->getLocation() === $this) {
                $peopleWhoVisited->setLocation(null);
            }
        }

        return $this;
    }
}
