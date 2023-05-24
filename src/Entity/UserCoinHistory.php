<?php

namespace App\Entity;

use App\Repository\UserCoinHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCoinHistoryRepository::class)]
class UserCoinHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userCoinHistories')]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'userCoinHistories')]
    private ?Category $Category = null;

    #[ORM\ManyToOne(inversedBy: 'userCoinHistories')]
    private ?Idea $Idea = null;

    #[ORM\Column]
    private ?int $coin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

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

    public function getCoin(): ?int
    {
        return $this->coin;
    }

    public function setCoin(int $coin): self
    {
        $this->coin = $coin;

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
