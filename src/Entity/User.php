<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $value = null;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Banana::class)]
    private Collection $bananas;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Coconut::class)]
    private Collection $coconuts;

    public function __construct()
    {
        $this->bananas = new ArrayCollection();
        $this->coconuts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, Banana>
     */
    public function getBananas(): Collection
    {
        return $this->bananas;
    }

    public function addBanana(Banana $banana): static
    {
        if (!$this->bananas->contains($banana)) {
            $this->bananas->add($banana);
            $banana->setUsers($this);
        }

        return $this;
    }

    public function removeBanana(Banana $banana): static
    {
        if ($this->bananas->removeElement($banana)) {
            // set the owning side to null (unless already changed)
            if ($banana->getUsers() === $this) {
                $banana->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, `Coconut`>
     */
    public function getCoconuts(): Collection
    {
        return $this->coconuts;
    }

    public function addCoconut(Coconut $coconut): static
    {
        if (!$this->coconuts->contains($coconut)) {
            $this->coconuts->add($coconut);
            $coconut->setUsers($this);
        }

        return $this;
    }

    public function removeCoconut(Coconut $coconut): static
    {
        if ($this->coconuts->removeElement($coconut)) {
            // set the owning side to null (unless already changed)
            if ($coconut->getUsers() === $this) {
                $coconut->setUsers(null);
            }
        }

        return $this;
    }
}
