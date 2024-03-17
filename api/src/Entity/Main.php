<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\DeleteMutation;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use App\Repository\MainRepository;
use App\State\Ext;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[ORM\Entity(repositoryClass: MainRepository::class)]
#[ApiResource(
    processor: Ext::class,
    normalizationContext: [AbstractNormalizer::GROUPS => ['Main:write']],
    denormalizationContext: [AbstractNormalizer::GROUPS => ['Main:write']],
    graphQlOperations: [
        new Query(
            denormalizationContext: ['groups' => ['Main:write']],
            normalizationContext: ['groups' => ['Main:write']]
        ),
        new QueryCollection(
            denormalizationContext: ['groups' => ['Main:write']],
            normalizationContext: ['groups' => ['Main:write']]
        ),
        new Mutation(
            name: 'create',
            denormalizationContext: ['groups' => ['Main:write']],
            normalizationContext: ['groups' => ['Main:write']]
        ),
        new Mutation(
            name: 'update',
            denormalizationContext: ['groups' => ['Main:write']],
            normalizationContext: ['groups' => ['Main:write']]
        ),
        new DeleteMutation(
            name: 'delete',
            denormalizationContext: ['groups' => ['Main:write']],
            normalizationContext: ['groups' => ['Main:write']]
        )
    ]
)]
class Main
{
    #[Groups(groups: ['Main:write'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    // #[ApiProperty(identifier: true, readable: true, writable: true)]
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
    #[ORM\ManyToOne(inversedBy: 'mains', cascade: ['remove', 'persist', 'refresh', 'merge', 'detach'])]
    private ?One $one = null;

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

    public function getOne(): ?One
    {
        return $this->one;
    }

    public function setOne(?One $one): static
    {
        $this->one = $one;

        return $this;
    }
}
