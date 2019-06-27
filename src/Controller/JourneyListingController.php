<?php

namespace App\Controller;

use App\Entity\Site;
use App\Repository\JourneyHasSiteRepository;
use App\Repository\JourneyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JourneyListingController extends AbstractController
{
    /**
     * @var JourneyHasSiteRepository
     */
    private $journeyHasSiteRepository;
    /**
     * @var JourneyRepository
     */
    private $journeyRepository;

    /**
     * @var \DateTime
     */
    private $yesterday;

    public function __construct(JourneyHasSiteRepository $journeyHasSiteRepository, JourneyRepository $journeyRepository)
    {
        $this->journeyHasSiteRepository = $journeyHasSiteRepository;
        $this->journeyRepository = $journeyRepository;

        $date = new \DateTime();

        $this->yesterday = $date->sub(new \DateInterval('P1D'));
    }

    /**
     * @Route("/journey/site/{id}", name="journey_listing")
     */
    public function index(Site $site)
    {
        $journeys = $this->journeyRepository->findJourneysBySite($site, $this->yesterday);

        $journeys = array_unique($journeys, SORT_REGULAR);

        return $this->render('journey_listing/index.html.twig', [
            'site' => $site,
            'journeys' => $journeys,
        ]);
    }

    /**
     * @Route("/journey/site", name="journey_listing_all")
     */
    public function allSites(){
        $journeys = $this->journeyRepository->findAllJourneys($this->yesterday);

        $journeys = array_unique($journeys, SORT_REGULAR);

        return $this->render('journey_listing/index.html.twig', [
            'site' => [
                'name' => 'Tous les sites',
                'id' => 0,
            ],
            'journeys' => $journeys,
        ]);
    }
}
