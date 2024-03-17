<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OneRepository::class)]
#[ApiResource]
class One
{
    #[Groups(groups: ['Main:write'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(groups: ['Main:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'one', targetEntity: Main::class)]
    private Collection $mains;

    public function __construct()
    {
        $this->mains = new ArrayCollection();
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
     * @return Collection<int, Main>
     */
    public function getMains(): Collection
    {
        return $this->mains;
    }

    public function addMain(Main $main): static
    {
        if (!$this->mains->contains($main)) {
            $this->mains->add($main);
            $main->setOne($this);
        }

        return $this;
    }

    public function removeMain(Main $main): static
    {
        if ($this->mains->removeElement($main)) {
            // set the owning side to null (unless already changed)
            if ($main->getOne() === $this) {
                $main->setOne(null);
            }
        }

        return $this;
    }
}
