<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JourneyHasSiteRepository")
 */
class JourneyHasSite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Journey", inversedBy="journeyHasSites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Journey;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="journeyHasSites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Site;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Start;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $End;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourney(): ?Journey
    {
        return $this->Journey;
    }

    public function setJourney(?Journey $Journey): self
    {
        $this->Journey = $Journey;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->Site;
    }

    public function setSite(?Site $Site): self
    {
        $this->Site = $Site;

        return $this;
    }

    public function getStart(): ?bool
    {
        return $this->Start;
    }

    public function setStart(bool $Start): self
    {
        $this->Start = $Start;

        return $this;
    }

    public function getEnd(): ?bool
    {
        return $this->End;
    }

    public function setEnd(bool $End): self
    {
        $this->End = $End;

        return $this;
    }
}
