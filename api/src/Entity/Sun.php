<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SunRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SunRepository::class)]
#[ApiResource]
class Sun
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'sub')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Main $main = null;

    #[ORM\ManyToOne(inversedBy: 'suns')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tip $tip = null;

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

    public function getMain(): ?Main
    {
        return $this->main;
    }

    public function setMain(?Main $main): static
    {
        $this->main = $main;

        return $this;
    }

    public function getTip(): ?Tip
    {
        return $this->tip;
    }

    public function setTip(?Tip $tip): static
    {
        $this->tip = $tip;

        return $this;
    }
}
