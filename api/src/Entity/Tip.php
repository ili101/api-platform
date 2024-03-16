<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TipRepository::class)]
#[ApiResource]
class Tip
{
    #[Groups(groups: ['Main:write'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(groups: ['Main:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'tip', targetEntity: Sub::class)]
    private Collection $subs;

    public function __construct()
    {
        $this->subs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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
     * @return Collection<int, Sub>
     */
    public function getSubs(): Collection
    {
        return $this->subs;
    }

    public function addSub(Sub $sub): static
    {
        if (!$this->subs->contains($sub)) {
            $this->subs->add($sub);
            $sub->setTip($this);
        }

        return $this;
    }

    public function removeSub(Sub $sub): static
    {
        if ($this->subs->removeElement($sub)) {
            // set the owning side to null (unless already changed)
            if ($sub->getTip() === $this) {
                $sub->setTip(null);
            }
        }

        return $this;
    }
}
