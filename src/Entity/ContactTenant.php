<?php

namespace App\Entity;

use App\Repository\ContactTenantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactTenantRepository::class)]
class ContactTenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $street;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'integer')]
    private $houseNumber;

    #[ORM\Column(type: 'integer')]
    private $zipCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $addrComplement;

    #[ORM\Column(type: 'integer')]
    private $TelNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getHouseNumber(): ?int
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(int $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getAddrComplement(): ?string
    {
        return $this->addrComplement;
    }

    public function setAddrComplement(?string $addrComplement): self
    {
        $this->addrComplement = $addrComplement;

        return $this;
    }

    public function getTelNumber(): ?int
    {
        return $this->TelNumber;
    }

    public function setTelNumber(int $TelNumber): self
    {
        $this->TelNumber = $TelNumber;

        return $this;
    }
}
