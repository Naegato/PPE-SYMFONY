<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $user = new user();
        // $manager->persist($user);

        $roles = array("Locataire", "Mandataire", "Bailleur");

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setRole($roles[rand(0,2)]);
            $user->setEmail("mail@gmail.com");
            $user->setPassword("motdepasse1234");
            $user->setIsVerified(rand(0,1)==1);
            $manager->persist($user);
            $this->addReference('user-'.$i, $user);
        }

        $manager->flush();
    }
}
