<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipRepository::class)]
#[ApiResource]
class Tip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'tip', targetEntity: Sun::class)]
    private Collection $suns;

    public function __construct()
    {
        $this->suns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Sun>
     */
    public function getSuns(): Collection
    {
        return $this->suns;
    }

    public function addSun(Sun $sun): static
    {
        if (!$this->suns->contains($sun)) {
            $this->suns->add($sun);
            $sun->setTip($this);
        }

        return $this;
    }

    public function removeSun(Sun $sun): static
    {
        if ($this->suns->removeElement($sun)) {
            // set the owning side to null (unless already changed)
            if ($sun->getTip() === $this) {
                $sun->setTip(null);
            }
        }

        return $this;
    }
}
