<?php

namespace App\Entity;

use App\Repository\LocataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LocataireRepository::class)
 * @APiResource(formats={"json"})
 */
class Locataire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Louer::class, mappedBy="locataire")
     */
    private $louers;

    public function __construct()
    {
        $this->louers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Louer[]
     */
    public function getLouers(): Collection
    {
        return $this->louers;
    }

    public function addLouer(Louer $louer): self
    {
        if (!$this->louers->contains($louer)) {
            $this->louers[] = $louer;
            $louer->setLocataire($this);
        }

        return $this;
    }

    public function removeLouer(Louer $louer): self
    {
        if ($this->louers->removeElement($louer)) {
            // set the owning side to null (unless already changed)
            if ($louer->getLocataire() === $this) {
                $louer->setLocataire(null);
            }
        }

        return $this;
    }
}
