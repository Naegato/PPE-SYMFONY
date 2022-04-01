<?php

namespace App\DataFixtures;

use App\Entity\Rent;
use App\Entity\Residence;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var User $tenant */
        $tenant = $this->getReference(UserFixtures::TENANT);

        for ($i = 0; $i < 4; $i++) {
            $rent = new Rent();

//            dd($date);

            $rent->setInventoryFile('');
            $rent->setArrivalDate(new \DateTime('2021-05-27'));
            $rent->setDepartureDate(new \DateTime('2022-05-27'));
            /** @var Residence $residence */
            $residence = $this->getReference('residence'.rand(0,9));
            $rent->setResidence($residence);
            $rent->setTenant($tenant);

            $rent->setRepresentativeComments('');
            $rent->setRepresentativeSignature('');
            $rent->setRepresentativeValidatedAt(new \DateTime('2021-05-27'));
            $rent->setTenantComments('');
            $rent->setTenantSignature('');
            $rent->setTenantValidatedAt(new \DateTime('2021-05-27'));

            $manager->persist($rent);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ResidenceFixtures::class,
        ];
    }
}