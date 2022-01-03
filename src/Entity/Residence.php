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
    private $code_postal;

    #[ORM\Column(type: 'string', length: 255)]
    private $pays;

    #[ORM\Column(type: 'string', length: 255)]
    private $fichier_inventaire;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $id_bailleur;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $id_mandataire;

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
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

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
        return $this->fichier_inventaire;
    }

    public function setFichierInventaire(string $fichier_inventaire): self
    {
        $this->fichier_inventaire = $fichier_inventaire;

        return $this;
    }

    public function getIdBailleur(): ?user
    {
        return $this->id_bailleur;
    }

    public function setIdBailleur(?user $id_bailleur): self
    {
        $this->id_bailleur = $id_bailleur;

        return $this;
    }

    public function getIdMandataire(): ?user
    {
        return $this->id_mandataire;
    }

    public function setIdMandataire(?user $id_mandataire): self
    {
        $this->id_mandataire = $id_mandataire;

        return $this;
    }
}
