<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MainRepository;
use App\State\Ext;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainRepository::class)]
#[ApiResource(
    processor: Ext::class
)]
class Main
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'main', targetEntity: Sun::class, orphanRemoval: true, cascade: ['remove', 'persist', 'refresh', 'merge', 'detach'])]
    #[ApiProperty(readableLink: true, writableLink: true, genId: false)]
    private Collection $sub;

    public function __construct()
    {
        $this->sub = new ArrayCollection();
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
    public function getSub(): Collection
    {
        return $this->sub;
    }

    public function addSub(Sun $sub): static
    {
        if (!$this->sub->contains($sub)) {
            $this->sub->add($sub);
            $sub->setMain($this);
        }

        return $this;
    }

    public function removeSub(Sun $sub): static
    {
        if ($this->sub->removeElement($sub)) {
            // set the owning side to null (unless already changed)
            if ($sub->getMain() === $this) {
                $sub->setMain(null);
            }
        }

        return $this;
    }
}
