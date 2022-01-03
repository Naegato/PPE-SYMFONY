<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $fichierInventaire;

    #[ORM\Column(type: 'datetime')]
    private $dateArriver;

    #[ORM\Column(type: 'datetime')]
    private $dateDepart;

    #[ORM\Column(type: 'string', length: 255)]
    private $commentaireLocataire;

    #[ORM\Column(type: 'string', length: 255)]
    private $signatureLocataire;

    #[ORM\Column(type: 'datetime')]
    private $dateValidationLocataire;

    #[ORM\Column(type: 'string', length: 255)]
    private $commentaireMandataire;

    #[ORM\Column(type: 'string', length: 255)]
    private $signatureMandataire;

    #[ORM\Column(type: 'datetime')]
    private $dateValidationMandataire;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $idLocataire;

    #[ORM\ManyToOne(targetEntity: residence::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $idResidence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichierInventaire(): ?string
    {
        return $this->fichierInventaire;
    }

    public function setFichierInventaire(string $fichierInventaire): self
    {
        $this->fichierInventaire = $fichierInventaire;

        return $this;
    }

    public function getDateArriver(): ?\DateTimeInterface
    {
        return $this->dateArriver;
    }

    public function setDateArriver(\DateTimeInterface $dateArriver): self
    {
        $this->dateArriver = $dateArriver;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getCommentaireLocataire(): ?string
    {
        return $this->commentaireLocataire;
    }

    public function setCommentaireLocataire(string $commentaireLocataire): self
    {
        $this->commentaireLocataire = $commentaireLocataire;

        return $this;
    }

    public function getSignatureLocataire(): ?string
    {
        return $this->signatureLocataire;
    }

    public function setSignatureLocataire(string $signatureLocataire): self
    {
        $this->signatureLocataire = $signatureLocataire;

        return $this;
    }

    public function getDateValidationLocataire(): ?\DateTimeInterface
    {
        return $this->dateValidationLocataire;
    }

    public function setDateValidationLocataire(\DateTimeInterface $dateValidationLocataire): self
    {
        $this->dateValidationLocataire = $dateValidationLocataire;

        return $this;
    }

    public function getCommentaireMandataire(): ?string
    {
        return $this->commentaireMandataire;
    }

    public function setCommentaireMandataire(string $commentaireMandataire): self
    {
        $this->commentaireMandataire = $commentaireMandataire;

        return $this;
    }

    public function getSignatureMandataire(): ?string
    {
        return $this->signatureMandataire;
    }

    public function setSignatureMandataire(string $signatureMandataire): self
    {
        $this->signatureMandataire = $signatureMandataire;

        return $this;
    }

    public function getDateValidationMandataire(): ?\DateTimeInterface
    {
        return $this->dateValidationMandataire;
    }

    public function setDateValidationMandataire(\DateTimeInterface $dateValidationMandataire): self
    {
        $this->dateValidationMandataire = $dateValidationMandataire;

        return $this;
    }

    public function getIdLocataire(): ?user
    {
        return $this->idLocataire;
    }

    public function setIdLocataire(?user $idLocataire): self
    {
        $this->idLocataire = $idLocataire;

        return $this;
    }

    public function getIdResidence(): ?residence
    {
        return $this->idResidence;
    }

    public function setIdResidence(?residence $idResidence): self
    {
        $this->idResidence = $idResidence;

        return $this;
    }
}
