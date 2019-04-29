<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JourneyRepository")
 */
class Journey
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JourneyHasSite", mappedBy="Journey", cascade={"persist"})
     */
    private $journeyHasSites;

    public function __construct()
    {
        $this->journeyHasSites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|JourneyHasSite[]
     */
    public function getJourneyHasSites(): Collection
    {
        return $this->journeyHasSites;
    }

    public function addJourneyHasSite(JourneyHasSite $journeyHasSite): self
    {
        if (!$this->journeyHasSites->contains($journeyHasSite)) {
            $this->journeyHasSites[] = $journeyHasSite;
            $journeyHasSite->setJourney($this);
        }

        return $this;
    }

    public function removeJourneyHasSite(JourneyHasSite $journeyHasSite): self
    {
        if ($this->journeyHasSites->contains($journeyHasSite)) {
            $this->journeyHasSites->removeElement($journeyHasSite);
            // set the owning side to null (unless already changed)
            if ($journeyHasSite->getJourney() === $this) {
                $journeyHasSite->setJourney(null);
            }
        }

        return $this;
    }
}
