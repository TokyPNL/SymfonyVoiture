<?php

namespace App\Entity;

use App\Repository\LouerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LouerRepository::class)
 * @APiResource(formats={"json"})
 */
class Louer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrJour;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateLocation;

    /**
     * @ORM\ManyToOne(targetEntity=Locataire::class, inversedBy="louers")
     */
    private $locataire;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="louers")
     */
    private $voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrJour(): ?int
    {
        return $this->nbrJour;
    }

    public function setNbrJour(?int $nbrJour): self
    {
        $this->nbrJour = $nbrJour;

        return $this;
    }

    public function getDateLocation(): ?\DateTimeInterface
    {
        return $this->dateLocation;
    }

    public function setDateLocation(?\DateTimeInterface $dateLocation): self
    {
        $this->dateLocation = $dateLocation;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
