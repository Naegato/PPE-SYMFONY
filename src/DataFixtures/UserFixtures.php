<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
         $user = new User();

         $user->setEmail("admin@admin.fr");
         $user->setRoles(["ROLE_ADMINISTRATOR"]);
         $user->setName('admin');
         $user->setLastname('admin');

         $password = $this->hasher->hashPassword($user, '123456');
         $user->setPassword($password);

         $manager->persist($user);

         $user2 = new User();

         $user2->setEmail("1@1.fr");
         $user2->setRoles(["ROLE_TENANT"]);
         $user2->setName('1');
         $user2->setLastname('1');

         $password2 = $this->hasher->hashPassword($user2, '123456');
         $user2->setPassword($password2);

         $manager->persist($user2);

         $user3 = new User();
         $user3->setEmail("2@2.fr");
         $user3->setRoles(["ROLE_REPRESENTATIVE"]);
         $user3->setName('3');
         $user3->setLastname('3');
         $password3 = $this->hasher->hashPassword($user3, '123456');
         $user3->setPassword($password3);
         $manager->persist($user3);

         $manager->flush();
    }
}
