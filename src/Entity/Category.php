<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?User $createdBy = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $finishesAt = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Idea::class)]
    private Collection $ideas;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: UserCoinHistory::class)]
    private Collection $userCoinHistories;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: TemporaryUserCoin::class)]
    private Collection $temporaryUserCoins;

    public function __construct()
    {
        $this->ideas = new ArrayCollection();
        $this->userCoinHistories = new ArrayCollection();
        $this->temporaryUserCoins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAT(\DateTimeInterface $createdAT): self
    {
        $this->createdAt = $createdAT;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getFinishesAt(): ?\DateTimeImmutable
    {
        return $this->finishesAt;
    }

    public function setFinishedAt(\DateTimeImmutable $finishedAt): self
    {
        $this->finishesAt = $finishedAt;

        return $this;
    }

    /**
     * @return Collection<int, Idea>
     */
    public function getIdeas(): Collection
    {
        return $this->ideas;
    }

    public function addIdea(Idea $idea): self
    {
        if (!$this->ideas->contains($idea)) {
            $this->ideas->add($idea);
            $idea->setCategory($this);
        }

        return $this;
    }

    public function removeIdea(Idea $idea): self
    {
        if ($this->ideas->removeElement($idea)) {
            // set the owning side to null (unless already changed)
            if ($idea->getCategory() === $this) {
                $idea->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserCoinHistory>
     */
    public function getUserCoinHistories(): Collection
    {
        return $this->userCoinHistories;
    }

    public function addUserCoinHistory(UserCoinHistory $userCoinHistory): self
    {
        if (!$this->userCoinHistories->contains($userCoinHistory)) {
            $this->userCoinHistories->add($userCoinHistory);
            $userCoinHistory->setCategory($this);
        }

        return $this;
    }

    public function removeUserCoinHistory(UserCoinHistory $userCoinHistory): self
    {
        if ($this->userCoinHistories->removeElement($userCoinHistory)) {
            // set the owning side to null (unless already changed)
            if ($userCoinHistory->getCategory() === $this) {
                $userCoinHistory->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TemporaryUserCoin>
     */
    public function getTemporaryUserCoins(): Collection
    {
        return $this->temporaryUserCoins;
    }

    public function addTemporaryUserCoin(TemporaryUserCoin $temporaryUserCoin): self
    {
        if (!$this->temporaryUserCoins->contains($temporaryUserCoin)) {
            $this->temporaryUserCoins->add($temporaryUserCoin);
            $temporaryUserCoin->setCategory($this);
        }

        return $this;
    }

    public function removeTemporaryUserCoin(TemporaryUserCoin $temporaryUserCoin): self
    {
        if ($this->temporaryUserCoins->removeElement($temporaryUserCoin)) {
            // set the owning side to null (unless already changed)
            if ($temporaryUserCoin->getCategory() === $this) {
                $temporaryUserCoin->setCategory(null);
            }
        }

        return $this;
    }

    public function getTotalCoinsBid(): int
    {
        $coinsBid = 0;
        foreach ($this->getIdeas() as $idea) {
            $coinsBid += $idea->getTotalBidCoins();
        }

        return $coinsBid;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getName(),
            'created_at' => $this->getCreatedAt(),
            'started_at' => $this->getStartedAt(),
            'finishes_at' => $this->getFinishesAt(),
            'idea_count' => $this->getIdeas()->count(),
            'total_coins_bid' =>  $this->getTotalCoinsBid(),
            'is_open' => $this->getFinishesAt() > new \DateTime(),
        ];
    }
}
