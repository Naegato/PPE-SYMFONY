<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $tenant;

    #[ORM\ManyToOne(targetEntity: residence::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $residence;

    #[ORM\Column(type: 'string', length: 255)]
    private $inventoryFile;

    #[ORM\Column(type: 'datetime')]
    private $arrivalDate;

    #[ORM\Column(type: 'datetime')]
    private $departureDate;

    #[ORM\Column(type: 'text')]
    private $tenantComments;

    #[ORM\Column(type: 'string', length: 255)]
    private $tenantSignature;

    #[ORM\Column(type: 'datetime')]
    private $tenantValidatedAt;

    #[ORM\Column(type: 'text')]
    private $representativeComments;

    #[ORM\Column(type: 'string', length: 255)]
    private $representativeSignature;

    #[ORM\Column(type: 'datetime')]
    private $representativeValidatedAt;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTenant(): ?user
    {
        return $this->tenant;
    }

    public function setTenant(?user $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getResidence(): ?residence
    {
        return $this->residence;
    }

    public function setResidence(?residence $residence): self
    {
        $this->residence = $residence;

        return $this;
    }

    public function getInventoryFile(): ?string
    {
        return $this->inventoryFile;
    }

    public function setInventoryFile(string $inventoryFile): self
    {
        $this->inventoryFile = $inventoryFile;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getTenantComments(): ?string
    {
        return $this->tenantComments;
    }

    public function setTenantComments(string $tenantComments): self
    {
        $this->tenantComments = $tenantComments;

        return $this;
    }

    public function getTenantSignature(): ?string
    {
        return $this->tenantSignature;
    }

    public function setTenantSignature(string $tenantSignature): self
    {
        $this->tenantSignature = $tenantSignature;

        return $this;
    }

    public function getTenantValidatedAt(): ?\DateTimeInterface
    {
        return $this->tenantValidatedAt;
    }

    public function setTenantValidatedAt(\DateTimeInterface $tenantValidatedAt): self
    {
        $this->tenantValidatedAt = $tenantValidatedAt;

        return $this;
    }

    public function getRepresentativeComments(): ?string
    {
        return $this->representativeComments;
    }

    public function setRepresentativeComments(string $representativeComments): self
    {
        $this->representativeComments = $representativeComments;

        return $this;
    }

    public function getRepresentativeSignature(): ?string
    {
        return $this->representativeSignature;
    }

    public function setRepresentativeSignature(string $representativeSignature): self
    {
        $this->representativeSignature = $representativeSignature;

        return $this;
    }

    public function getRepresentativeValidatedAt(): ?\DateTimeInterface
    {
        return $this->representativeValidatedAt;
    }

    public function setRepresentativeValidatedAt(\DateTimeInterface $representativeValidatedAt): self
    {
        $this->representativeValidatedAt = $representativeValidatedAt;

        return $this;
    }


}
