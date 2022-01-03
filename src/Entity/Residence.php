<?php

namespace App\Entity;

use App\Repository\ResidenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResidenceRepository::class)]
class Residence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    #[ORM\Column(type: 'string', length: 255)]
    private $codePostal;

    #[ORM\Column(type: 'string', length: 255)]
    private $pays;

    #[ORM\Column(type: 'string', length: 255)]
    private $fichierInventaire;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $idBailleur;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $idMandataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
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

    public function getIdBailleur(): ?user
    {
        return $this->idBailleur;
    }

    public function setIdBailleur(?user $idBailleur): self
    {
        $this->idBailleur = $idBailleur;

        return $this;
    }

    public function getIdMandataire(): ?user
    {
        return $this->idMandataire;
    }

    public function setIdMandataire(?user $idMandataire): self
    {
        $this->idMandataire = $idMandataire;

        return $this;
    }
}
