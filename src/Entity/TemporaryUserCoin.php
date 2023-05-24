<?php

namespace App\Entity;

use App\Repository\TemporaryUserCoinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemporaryUserCoinRepository::class)]
class TemporaryUserCoin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'temporaryUserCoins')]
    private ?Category $Category = null;

    #[ORM\ManyToOne(inversedBy: 'temporaryUserCoins')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'temporaryUserCoins')]
    private ?Idea $Idea = null;

    #[ORM\Column]
    private ?int $spentCoin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getIdea(): ?Idea
    {
        return $this->Idea;
    }

    public function setIdea(?Idea $Idea): self
    {
        $this->Idea = $Idea;

        return $this;
    }

    public function getSpentCoin(): ?int
    {
        return $this->spentCoin;
    }

    public function setSpentCoin(int $spentCoin): self
    {
        $this->spentCoin = $spentCoin;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
