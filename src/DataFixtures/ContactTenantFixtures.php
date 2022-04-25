<?php

namespace App\DataFixtures;

use App\Entity\ContactTenant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ContactTenantFixtures extends Fixture
{
    public const FIRST_ADDRESS = "test";

    public function load(ObjectManager $manager)
    {


        $ContactTenant = new ContactTenant();
        $ContactTenant->setZipCode(mt_rand(10000, 99999));
        $ContactTenant->setCity('Paris');
        $ContactTenant->setStreet('Rue du test');
        $ContactTenant->setHouseNumber(mt_rand(0, 999));
        $ContactTenant->setTelNumber('0607080910');
        $ContactTenant->setAddrComplement('Bat 7');
        $this->setReference(self::FIRST_ADDRESS, $ContactTenant);
    }
}