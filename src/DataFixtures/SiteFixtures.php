<?php

namespace App\DataFixtures;

use App\Entity\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SiteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $locations = [
        ['AIDER SANTÉ Font-Romeu', '12, rue de la Liberté<br />66 120 Font-Romeu<br />Secrétariat Médical : 04 30 82 16 24<br /><a href="/sites/uad-font-romeu/">En savoir plus</a>', 'UAD', 42.49747259999999,2.035312500000032,1 ],

        ['AIDER SANTÉ Narbonne', 'Les conviviales,<br />10 quai d’Alsace<br />11 100 Narbonne<br />Secrétariat Médical – Polyclinique Le Languedoc (Narbonne), service néphrologie : 04 68 32 82 35<br /><a href="/sites/unite-de-dialyse-de-narbonne/">En savoir plus</a>', 'UAD',43.18808269999999, 2.9970233000000235, 2 ],

        ['AIDER SANTÉ Carcassonne', '1060, chemin de la Madeleine<br />CS 50067<br />11890 CARCASSONNE Cedex<br />Secrétariat Médical : 04 30 73 10 13<br /><a href="/sites/unite-de-dialyse-de-carcassonne/">En savoir plus</a>', 'CP',43.2214165, 2.3939573999999766, 3 ],

        ['AIDER SANTÉ Montpellier', 'Clinique Jacques Mirouze<br />Site du C.H.U Lapeyronie<br />191, Avenue Doyen Gaston Giraud<br />34295 Montpellier Cedex 5<br />Accueil : 04 30 78 18 68<br /><a href="/sites/unite-de-dialyse-du-chu-lapeyronie/">En savoir plus</a>', 'ENT',43.6314144, 3.8507945000000063, 7 ],

        ['AIDER SANTÉ Trèbes', 'ZA de l’Europe<br>Route de Narbonne<br>11 800 Trèbes<br>Secrétariat Médical : 04 30 73 10 13<br><a href="/sites/unite-de-dialyse-de-trebes/">En savoir plus</a>', 'UAD',43.2048136, 2.438662499999964,9 ],

        ['AIDER SANTÉ Villeneuve-les-Béziers', 'Résidence les Jardins de Canalet<br>Rue Louis Dardé<br>34 420 Villeneuve-les-Béziers<br>Secrétariat Médical : 04 67 26 76 82<br><a href="/sites/unite-de-dialyse-de-villeneuve-les-beziers/">En savoir plus</a>', 'UAD',43.31643649999999, 3.2786217000000306,10 ],

        ['AIDER SANTÉ Clermont l\'Hérault', 'Site du C.H. de Clermont l\'Hérault<br>Cours de la Chicane<br>34 800 Clermont l\'Hérault<br>Accueil : 04 30 78 18 68<br>Secrétariat Médical : 04 30 78 18 73<br><a href="/sites/centre-de-dialyse-de-clermont-lherault/">En savoir plus</a>', 'UAD',43.62905680000001, 3.437345499999992,11 ],

        ['AIDER SANTÉ Ganges', 'Site de la Polyclinique Saint Louis<br >Place Joseph Boudouresque<br > 34 190 Ganges<br >Accueil : 04 30 78 18 68<br >Secrétariat Médical : 04 30 78 18 73<br ><a href="/sites/unite-de-dialyse-de-la-polyclinique-saint-louis/">En savoir plus</a>', 'CP',43.93273139999999, 3.7024710000000596,14 ],

        ['AIDER SANTÉ Limoux', 'Site du C.H. Limoux-Quillan<br >Rue de la Madeleine<br >11 300 Limoux<br >Secrétariat Médical : 04 30 73 10 13<br ><a href="/sites/unite-de-dialyse-de-lhopital-limoux-quillan/">En savoir plus</a>', 'UAD',43.0549486, 2.2198598999999604,15 ],

        ['AIDER SANTÉ Perpignan', 'Site du C.H. Saint Jean Roussillon<br >BP 49954<br >20 avenue du Languedoc<br >66 046 Perpignan Cedex 9<br >Secrétariat Médical : 04 30 82 16 24<br ><a href="/sites/unite-de-dialyse-de-lhopital-saint-jean-roussillon/">En savoir plus</a>', 'ENT',42.7240036, 2.8880340000000615, 18 ],

        ['AIDER SANTÉ Elne', '22, Av. Paul Reigt<br >66 200 Elne<br >Secrétariat Médical : 04 30 82 16 24<br ><a href="/sites/unite-de-dialyse-delne/">En savoir plus</a>', 'UAD',42.5962044, 2.975596600000017,19    ],

        ['AIDER SANTÉ Le Boulou', 'Immeuble Autoport<br>RD 115 - BP 79<br>66161 Le Boulou<br>Secrétariat Médical : 04 30 82 16 24<br><a href="/sites/unite-de-dialyse-du-boulou/">En savoir plus</a>', 'UAD',42.51150820000001, 2.828137100000049,20 ],

        ['AIDER SANTÉ Grabels', '805, rue de la Valsière<br>34 790 Grabels<br>Accueil : 04 30 78 18 68 <br>Secrétariat Médical : 04 30 78 18 73<br><a href="/sites/site-joseph-cordier-1/">En savoir plus</a>', 'UAD',43.64693810000001, 3.8312422000000197,21 ],

        ['AIDER SANTÉ Bouzigues', '28 bis, av. Alfred Bouat<br>34 140 Bouzigues<br>Accueil : 04 30 78 18 68<br>Secrétariat Médical : 04 30 78 18 61<br><a href="/sites/centre-de-dialyse-de-bouzigues/">En savoir plus</a>', 'UAD',43.4514667, 3.6549582999999757,22 ],

        ['AIDER SANTÉ Bédarieux', 'Ecoparc Phoros<br>Route de Saint-Pons<br>34 600 Bédarieux<br>Accueil : 04 30 78 18 68<br>Secrétariat Médical : 04 30 78 18 73<br><a href="/sites/centre-de-dialyse-de-bedarieux/">En savoir plus</a>', 'UAD',43.59914, 3.141156300000034, 23    ],

        ['AIDER SANTÉ Mende',  'Site du C.H. de Mende<br>Av. du 8 Mai 1945<br>48 001 Mende<br>Secrétariat Médical : 04 30 77 10 02<br><a href="/sites/unite-de-dialyse-du-centre-hospitalier-de-mende/">En savoir plus</a>', 'CP',44.5317705, 3.490349100000003,24],

        ['AIDER SANTÉ Marvejols', 'Site du C.H. Lozère Site de Marvejols<br>Chemin Jean Fontugne<br>48100 Marvejols<br>Secrétariat Médical : 04 30 77 10 02<br><a href="/sites/unite-de-dialyse-de-la-clinique-medico-chirurgicale-mutualiste/">En savoir plus</a>', 'ENT',44.56536699999999, 3.2931330000000116, 28 ],

        ['AIDER SANTÉ Millau', '907, Rue de Naulas<br />12 100 Millau<br />Secrétariat Médical : 05 65 58 45 70<br /><a href="/sites/unite-de-dialyse-du-centre-hospitalier-millau/">En savoir plus </a>', 'ENT',44.0946826, 3.055149300000039,32 ],

        ['AIDER SANTÉ Nîmes', 'Site du C.H.U Caremeau<br />Place du Pr. Robert Debré<br />30 029 Nîmes Cedex 9<br />Secrétariat Médical : 04 30 81 13 21<br /><a href="/sites/groupe-hospitalo-universitaire-caremeau/">En savoir plus</a>', 'ENT',43.8238328, 4.326247800000033,33 ],

        ['AIDER SANTÉ Bagnols sur Cèze', '85 avenue de Frontresquières<br />30 200 Bagnols/Cèze<br />Secrétariat Médical : 04 30 68 13 20<br /><a href="/sites/unite-de-dialyse-de-bagnols-sur-ceze/">En savoir plus</a>', 'UAD',44.1594067, 4.607298700000001,34 ],

        ['AIDER SANTÉ Alès', '414, chemin des Potences<br />30 100 Alès<br />Secrétariat Médical : 04 30 63 13 20<br /><a href="/sites/centre-de-dialyse-de-lhopital-dales/">En savoir plus</a>', 'ENT',44.1484075, 4.094668500000012,39 ],
    ];


        // $product = new Product();
        // $manager->persist($product);
        foreach ($locations as $location){
            $site = new Site();
            $site->setName($location[0]);
            $site->setLat($location[3]);
            $site->setLon($location[4]);
            $manager->persist($site);
        }
        $manager->flush();
    }
}
