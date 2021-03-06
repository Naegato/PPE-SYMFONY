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

    #[ORM\Column(type: 'datetime')]
    private $arrival_date;

    #[ORM\Column(type: 'datetime')]
    private $departure_date;

    #[ORM\Column(type: 'text', nullable: true)]
    private $tenant_comments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tenant_signature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $tenant_validated_at;

    #[ORM\Column(type: 'text', nullable: true)]
    private $representative_comments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $representative_signature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $representative_validated_at;

    #[ORM\Column(type: 'text', nullable: true)]
    private $tenant_inventory_comments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tenant_inventory_signature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $tenant_inventory_validated_at;

    #[ORM\Column(type: 'text', nullable: true)]
    private $representative_inventory_comments;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $representative_inventory_signature;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $representative_inventory_validated_at;

    #[ORM\ManyToOne(targetEntity: Residence::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $residence;

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

    public function getResidence(): ?Residence
    {
        return $this->residence;
    }

    public function setResidence(?Residence $residence): self
    {
        $this->residence = $residence;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrival_date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_date): self
    {
        $this->arrival_date = $arrival_date;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departure_date;
    }

    public function setDepartureDate(\DateTimeInterface $departure_date): self
    {
        $this->departure_date = $departure_date;
        return $this;
    }

    public function getTenantComments(): ?string
    {
        return $this->tenant_comments;
    }

    public function setTenantComments(string $tenant_comments): self
    {
        $this->tenant_comments = $tenant_comments;

        return $this;
    }

    public function getTenantSignature(): ?string
    {
        return $this->tenant_signature;
    }

    public function setTenantSignature(string $tenant_signature): self
    {
        $this->tenant_signature = $tenant_signature;

        return $this;
    }

    public function getTenantValidatedAt(): ?\DateTimeInterface
    {
        return $this->tenant_validated_at;
    }

    public function setTenantValidatedAt(\DateTimeInterface $tenant_validated_at): self
    {
        $this->tenant_validated_at = $tenant_validated_at;

        return $this;
    }

    public function getRepresentativeComments(): ?string
    {
        return $this->representative_comments;
    }

    public function setRepresentativeComments(string $representative_comments): self
    {
        $this->representative_comments = $representative_comments;

        return $this;
    }

    public function getRepresentativeSignature(): ?string
    {
        return $this->representative_signature;
    }

    public function setRepresentativeSignature(string $representative_signature): self
    {
        $this->representative_signature = $representative_signature;

        return $this;
    }

    public function getRepresentativeValidatedAt(): ?\DateTimeInterface
    {
        return $this->representative_validated_at;
    }

    public function setRepresentativeValidatedAt(\DateTimeInterface $representative_validated_at): self
    {
        $this->representative_validated_at = $representative_validated_at;

        return $this;
    }

    public function getRepresentativeInventoryValidatedAt(): ?\DateTimeInterface
    {
        return $this->representative_inventory_validated_at;
    }

    public function setRepresentativeInventoryValidatedAt(?\DateTimeInterface $representative_inventory_validated_at): self
    {
        $this->representative_inventory_validated_at = $representative_inventory_validated_at;

        return $this;
    }

    public function getTenantInventoryComments(): ?string
    {
        return $this->tenant_inventory_comments;
    }

    public function setTenantInventoryComments(?string $tenant_inventory_comments): self
    {
        $this->tenant_inventory_comments = $tenant_inventory_comments;

        return $this;
    }

    public function getTenantInventorySignature(): ?string
    {
        return $this->tenant_inventory_signature;
    }

    public function setTenantInventorySignature(?string $tenant_inventory_signature): self
    {
        $this->tenant_inventory_signature = $tenant_inventory_signature;

        return $this;
    }

    public function getTenantInventoryValidatedAt(): ?\DateTimeInterface
    {
        return $this->tenant_inventory_validated_at;
    }

    public function setTenantInventoryValidatedAt(?\DateTimeInterface $tenant_inventory_validated_at): self
    {
        $this->tenant_inventory_validated_at = $tenant_inventory_validated_at;

        return $this;
    }

    public function getRepresentativeInventoryComments(): ?string
    {
        return $this->representative_inventory_comments;
    }

    public function setRepresentativeInventoryComments(?string $representative_inventory_comments): self
    {
        $this->representative_inventory_comments = $representative_inventory_comments;

        return $this;
    }

    public function getRepresentativeInventorySignature(): ?string
    {
        return $this->representative_inventory_signature;
    }

    public function setRepresentativeInventorySignature($representative_inventory_signature): self
    {
        $this->representative_inventory_signature = $representative_inventory_signature;

        return $this;
    }
}
