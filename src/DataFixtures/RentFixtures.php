<?php

namespace App\DataFixtures;

use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RentFixtures extends Fixture implements DependentFixtureInterface
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
            $rent = new Rent();
            $rent->setInventoryFile("FichierInv-".$i.".pdf");
            $rent->setArrivalDate($date);
            $rent->setDepartureDate($date);
            $rent->setTenantComments("c'est super !");
            $rent->setTenantSignature("signatureL");
            $rent->setTenantValidatedAt($date);
            $rent->setRepresentativeComments("parfait !");
            $rent->setRepresentativeSignature("signatureM");
            $rent->setRepresentativeValidatedAt($date);
            $rent->setTenant($this->getReference('user-'.rand(1,19)));
            $rent->setResidence($this->getReference('Residence-'.rand(1,19)));
            $manager->persist($rent);
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
