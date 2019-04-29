<?php

namespace App\Controller;

use App\Entity\Journey;
use App\Entity\JourneyHasSite;
use App\FlashMessage\AddFlashTrait;
use App\FlashMessage\FlashMessageCategory;
use App\Form\JourneyHasSiteType;
use App\Form\JourneyType;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IndexController extends AbstractController
{
    /**
     * @var SiteRepository
     */
    private $siteRepository;

    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $sites = $serializer->serialize($this->siteRepository->findAll(), 'json');
//        $sites = $serializer->serialize(array(), 'json');

        $journey = new Journey();
        $journey->setDate(new \DateTimeImmutable());

        $form = $this->createForm(JourneyType::class, $journey);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $journeyHasSites = $data->getJourneyHasSites();

            $i=0;
            foreach($journeyHasSites as $journeyHasSite){
                if ($i===0){
                    $journeyHasSite->setStart(true);
                }
                if ($i === count($journeyHasSites)-1){
                    $journeyHasSite->setEnd(true);
                }
                $i++;
            }
            $em->persist($data);
            $em->flush();

            $this->addFlash(FlashMessageCategory::SUCCESS, 'Trajet Ajouté avec succes');

            return $this->redirectToRoute('index');
        }


        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'IndexController',
            'sites' => $sites,
        ]);
    }
}
