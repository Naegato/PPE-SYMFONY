<?php

namespace App\DataFixtures;

use App\Entity\Residence;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResidenceFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $city = ["Paris","Creil","Senlis"];
        /** @var User $owner */
        $owner = $this->getReference(UserFixtures::ADMIN);
        /** @var User $representative */
        $representative = $this->getReference(UserFixtures::REPRESENTATIVE);

        for ($i = 0 ; $i < 10 ; $i++) {
            $residence = new Residence();

            $residence->setCity($city[array_rand($city)]);
            $residence->setAddress('1 rue de la paix');
            $residence->setCountry("france");
            $residence->setName("residence $i");
            $residence->setOwner($owner);
            $residence->setRepresentative($representative);
            $residence->setZipCode("60???");
            $residence->setInventoryFile('?');

            $manager->persist($residence);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
