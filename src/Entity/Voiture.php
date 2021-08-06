<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 * @APiResource(formats={"json"})
 */
class Voiture
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
    private $design;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $loyer;

    /**
     * @ORM\OneToMany(targetEntity=Louer::class, mappedBy="voiture")
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

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(?string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getLoyer(): ?int
    {
        return $this->loyer;
    }

    public function setLoyer(?int $loyer): self
    {
        $this->loyer = $loyer;

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
            $louer->setVoiture($this);
        }

        return $this;
    }

    public function removeLouer(Louer $louer): self
    {
        if ($this->louers->removeElement($louer)) {
            // set the owning side to null (unless already changed)
            if ($louer->getVoiture() === $this) {
                $louer->setVoiture(null);
            }
        }

        return $this;
    }
}
