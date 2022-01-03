<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        //création d'un timestamp aléatoire
        $timestamp = mt_rand(1, time());
        $date = new \DateTime("2009-04-10");
        $date->setTimestamp($timestamp);

        for ($i = 0; $i < 20; $i++) {
            $location = new Location();
            $location->setFichierInventaire("FichierInv-".$i.".pdf");
            $location->setDateArriver($date);
            $location->setDateDepart($date);
            $location->setCommentaireLocataire("c'est super !");
            $location->setSignatureLocataire("signatureL");
            $location->setDateValidationLocataire($date);
            $location->setCommentaireMandataire("parfait !");
            $location->setSignatureMandataire("signatureM");
            $location->setDateValidationMandataire($date);
            $location->setIdLocataire($this->getReference('user-'.rand(1,19)));
            $location->setIdResidence($this->getReference('Residence-'.rand(1,19)));
            $manager->persist($location);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ResidenceFixtures::class,
        ];
    }

}
