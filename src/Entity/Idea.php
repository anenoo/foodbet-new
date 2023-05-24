<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdeaRepository::class)]
class Idea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 512)]
    private ?string $title = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\ManyToOne(inversedBy: 'ideas')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'ideas')]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'Idea', targetEntity: UserCoinHistory::class)]
    private Collection $userCoinHistories;

    #[ORM\OneToMany(mappedBy: 'Idea', targetEntity: TemporaryUserCoin::class)]
    private Collection $temporaryUserCoins;

    public function __construct()
    {
        $this->userCoinHistories = new ArrayCollection();
        $this->temporaryUserCoins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $userCoinHistory->setIdea($this);
        }

        return $this;
    }

    public function removeUserCoinHistory(UserCoinHistory $userCoinHistory): self
    {
        if ($this->userCoinHistories->removeElement($userCoinHistory)) {
            // set the owning side to null (unless already changed)
            if ($userCoinHistory->getIdea() === $this) {
                $userCoinHistory->setIdea(null);
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
            $temporaryUserCoin->setIdea($this);
        }

        return $this;
    }

    public function removeTemporaryUserCoin(TemporaryUserCoin $temporaryUserCoin): self
    {
        if ($this->temporaryUserCoins->removeElement($temporaryUserCoin)) {
            // set the owning side to null (unless already changed)
            if ($temporaryUserCoin->getIdea() === $this) {
                $temporaryUserCoin->setIdea(null);
            }
        }

        return $this;
    }
}
