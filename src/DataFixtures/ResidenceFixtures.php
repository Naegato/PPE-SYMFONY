<?php

namespace App\DataFixtures;

use App\Entity\Residence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResidenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 20; $i++) {
            $residence = new Residence();
            $residence->setName("nom".$i);
            $residence->setAdress($i."rue de paris");
            $residence->setCity("Nogent-sur-Oise");
            $residence->setZipCode("60180");
            $residence->setCountry("France");
            $residence->setInventoryFile("FichierInv-".$i.".pdf");
            $residence->setOwner($this->getReference('user-'.rand(1,19)));
            $residence->setRepresentative($this->getReference('user-'.rand(1,19)));
            $manager->persist($residence);
            $this->addReference('Residence-'.$i, $residence);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }

}
