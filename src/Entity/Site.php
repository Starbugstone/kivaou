<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 */
class Site
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     */
    private $lon;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JourneyHasSite", mappedBy="Site")
     */
//    private $journeyHasSites;
//
//    public function __construct()
//    {
//        $this->journeyHasSites = new ArrayCollection();
//    }

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

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

//    /**
//     * @return Collection|JourneyHasSite[]
//     */
//    public function getJourneyHasSites(): Collection
//    {
//        return $this->journeyHasSites;
//    }

//    public function addJourneyHasSite(JourneyHasSite $journeyHasSite): self
//    {
//        if (!$this->journeyHasSites->contains($journeyHasSite)) {
//            $this->journeyHasSites[] = $journeyHasSite;
//            $journeyHasSite->setSite($this);
//        }
//
//        return $this;
//    }
//
//    public function removeJourneyHasSite(JourneyHasSite $journeyHasSite): self
//    {
//        if ($this->journeyHasSites->contains($journeyHasSite)) {
//            $this->journeyHasSites->removeElement($journeyHasSite);
//            // set the owning side to null (unless already changed)
//            if ($journeyHasSite->getSite() === $this) {
//                $journeyHasSite->setSite(null);
//            }
//        }
//
//        return $this;
//    }

    public function __toString():?string
    {
        return $this->id;
    }
}
