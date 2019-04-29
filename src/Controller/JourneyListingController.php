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

    public function __construct(JourneyHasSiteRepository $journeyHasSiteRepository, JourneyRepository $journeyRepository)
    {
        $this->journeyHasSiteRepository = $journeyHasSiteRepository;
        $this->journeyRepository = $journeyRepository;
    }

    /**
     * @Route("/journey/site/{id}", name="journey_listing")
     */
    public function index(Site $site)
    {
        $journeys = $this->journeyRepository->findJourneysBySite($site, new \DateTime('01/04/2019'));

        $journeys = array_unique($journeys, SORT_REGULAR);

        return $this->render('journey_listing/index.html.twig', [
            'controller_name' => 'JourneyListingController',
            'site' => $site,
            'journeys' => $journeys,
        ]);
    }
}
