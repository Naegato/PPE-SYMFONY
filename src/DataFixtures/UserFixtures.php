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

    public const ADMIN = "admin";
    public const REPRESENTATIVE = "representative";
    public const TENANT = "tenant";

    public function load(ObjectManager $manager): void
    {
         $admin = new User();

         $admin->setEmail("admin@admin.fr");
         $admin->setRoles(["ROLE_ADMINISTRATOR"]);
         $admin->setName('admin');
         $admin->setLastname('admin');

         $passwordAdmin = $this->hasher->hashPassword($admin, '123456');
         $admin->setPassword($passwordAdmin);

         $manager->persist($admin);


         for ($i = 0; $i < 25; $i++) {

             $tenant = new User();

             $tenant->setEmail("tenant$i@tenant.fr");
             $tenant->setRoles(["ROLE_TENANT"]);
             $tenant->setName("tenant$i");
             $tenant->setLastname('tenant');

             $passwordTenant = $this->hasher->hashPassword($tenant, '123456');
             $tenant->setPassword($passwordTenant);

             $manager->persist($tenant);
         }

         $representative = new User();
         $representative->setEmail("representative@representative.fr");
         $representative->setRoles(["ROLE_REPRESENTATIVE"]);
         $representative->setName('representative');
         $representative->setLastname('representative');
         $passwordRepresentative = $this->hasher->hashPassword($representative, '123456');
         $representative->setPassword($passwordRepresentative);
         $manager->persist($representative);

         $this->addReference(self::ADMIN, $admin);
         $this->addReference(self::TENANT, $tenant);
         $this->addReference(self::REPRESENTATIVE, $representative);
         

         $manager->flush();

    }
}
