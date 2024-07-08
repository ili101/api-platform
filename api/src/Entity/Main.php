<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[ORM\Entity(repositoryClass: MainRepository::class)]
#[ApiResource(
    normalizationContext: [AbstractNormalizer::GROUPS => ['Main:write']],
    denormalizationContext: [
        AbstractNormalizer::GROUPS => ['Main:write'],
    ],
)]
class Main
{
    #[Groups(groups: ['Main:write'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(groups: ['Main:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(groups: ['Main:write'])]
    #[ORM\OneToMany(mappedBy: 'main', targetEntity: Sub::class, orphanRemoval: true, cascade: ['remove', 'persist', 'refresh', 'merge', 'detach'])]
    #[ApiProperty(readableLink: true, writableLink: true)]
    private Collection $subs;

    #[Groups(groups: ['Main:write'])]
    #[ApiProperty(readableLink: true, writableLink: true)]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Sub $sub1 = null;

    #[Groups(groups: ['Main:write'])]
    #[ApiProperty(readableLink: true, writableLink: true)]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Sub $sub2 = null;

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
            $sub->setMain($this);
        }

        return $this;
    }

    public function removeSub(Sub $sub): static
    {
        if ($this->subs->removeElement($sub)) {
            // set the owning side to null (unless already changed)
            if ($sub->getMain() === $this) {
                $sub->setMain(null);
            }
        }

        return $this;
    }

    public function getSub1(): ?Sub
    {
        return $this->sub1;
    }

    public function setSub1(?Sub $sub1): static
    {
        $this->sub1 = $sub1;

        return $this;
    }

    public function getSub2(): ?Sub
    {
        return $this->sub2;
    }

    public function setSub2(?Sub $sub2): static
    {
        $this->sub2 = $sub2;

        return $this;
    }
}
