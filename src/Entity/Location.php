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
    private $fichier_inventaire;

    #[ORM\Column(type: 'datetime')]
    private $date_arriver;

    #[ORM\Column(type: 'datetime')]
    private $date_depart;

    #[ORM\Column(type: 'string', length: 255)]
    private $commentaire_locataire;

    #[ORM\Column(type: 'string', length: 255)]
    private $signature_locataire;

    #[ORM\Column(type: 'datetime')]
    private $date_validation_locataire;

    #[ORM\Column(type: 'string', length: 255)]
    private $commentaire_mandataire;

    #[ORM\Column(type: 'string', length: 255)]
    private $signature_mandataire;

    #[ORM\Column(type: 'datetime')]
    private $date_validation_mandataire;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $id_locataire;

    #[ORM\ManyToOne(targetEntity: residence::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $id_residence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichierInventaire(): ?string
    {
        return $this->fichier_inventaire;
    }

    public function setFichierInventaire(string $fichier_inventaire): self
    {
        $this->fichier_inventaire = $fichier_inventaire;

        return $this;
    }

    public function getDateArriver(): ?\DateTimeInterface
    {
        return $this->date_arriver;
    }

    public function setDateArriver(\DateTimeInterface $date_arriver): self
    {
        $this->date_arriver = $date_arriver;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getCommentaireLocataire(): ?string
    {
        return $this->commentaire_locataire;
    }

    public function setCommentaireLocataire(string $commentaire_locataire): self
    {
        $this->commentaire_locataire = $commentaire_locataire;

        return $this;
    }

    public function getSignatureLocataire(): ?string
    {
        return $this->signature_locataire;
    }

    public function setSignatureLocataire(string $signature_locataire): self
    {
        $this->signature_locataire = $signature_locataire;

        return $this;
    }

    public function getDateValidationLocataire(): ?\DateTimeInterface
    {
        return $this->date_validation_locataire;
    }

    public function setDateValidationLocataire(\DateTimeInterface $date_validation_locataire): self
    {
        $this->date_validation_locataire = $date_validation_locataire;

        return $this;
    }

    public function getCommentaireMandataire(): ?string
    {
        return $this->commentaire_mandataire;
    }

    public function setCommentaireMandataire(string $commentaire_mandataire): self
    {
        $this->commentaire_mandataire = $commentaire_mandataire;

        return $this;
    }

    public function getSignatureMandataire(): ?string
    {
        return $this->signature_mandataire;
    }

    public function setSignatureMandataire(string $signature_mandataire): self
    {
        $this->signature_mandataire = $signature_mandataire;

        return $this;
    }

    public function getDateValidationMandataire(): ?\DateTimeInterface
    {
        return $this->date_validation_mandataire;
    }

    public function setDateValidationMandataire(\DateTimeInterface $date_validation_mandataire): self
    {
        $this->date_validation_mandataire = $date_validation_mandataire;

        return $this;
    }

    public function getIdLocataire(): ?user
    {
        return $this->id_locataire;
    }

    public function setIdLocataire(?user $id_locataire): self
    {
        $this->id_locataire = $id_locataire;

        return $this;
    }

    public function getIdResidence(): ?residence
    {
        return $this->id_residence;
    }

    public function setIdResidence(?residence $id_residence): self
    {
        $this->id_residence = $id_residence;

        return $this;
    }
}
