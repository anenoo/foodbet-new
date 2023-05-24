<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\Column]
    private ?int $totalCoins = null;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Category::class)]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Idea::class)]
    private Collection $ideas;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: UserCoinHistory::class)]
    private Collection $userCoinHistories;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: TemporaryUserCoin::class)]
    private Collection $temporaryUserCoins;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->ideas = new ArrayCollection();
        $this->userCoinHistories = new ArrayCollection();
        $this->temporaryUserCoins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getTotalCoins(): ?int
    {
        return $this->totalCoins;
    }

    public function setTotalCoins(int $totalCoins): self
    {
        $this->totalCoins = $totalCoins;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addStartedAt(Category $startedAt): self
    {
        if (!$this->categories->contains($startedAt)) {
            $this->categories->add($startedAt);
            $startedAt->setCreatedBy($this);
        }

        return $this;
    }

    public function removeStartedAt(Category $startedAt): self
    {
        if ($this->categories->removeElement($startedAt)) {
            // set the owning side to null (unless already changed)
            if ($startedAt->getCreatedBy() === $this) {
                $startedAt->setCreatedBy(null);
            }
        }

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
            $idea->setUser($this);
        }

        return $this;
    }

    public function removeIdea(Idea $idea): self
    {
        if ($this->ideas->removeElement($idea)) {
            // set the owning side to null (unless already changed)
            if ($idea->getUser() === $this) {
                $idea->setUser(null);
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
            $userCoinHistory->setUser($this);
        }

        return $this;
    }

    public function removeUserCoinHistory(UserCoinHistory $userCoinHistory): self
    {
        if ($this->userCoinHistories->removeElement($userCoinHistory)) {
            // set the owning side to null (unless already changed)
            if ($userCoinHistory->getUser() === $this) {
                $userCoinHistory->setUser(null);
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
            $temporaryUserCoin->setUser($this);
        }

        return $this;
    }

    public function removeTemporaryUserCoin(TemporaryUserCoin $temporaryUserCoin): self
    {
        if ($this->temporaryUserCoins->removeElement($temporaryUserCoin)) {
            // set the owning side to null (unless already changed)
            if ($temporaryUserCoin->getUser() === $this) {
                $temporaryUserCoin->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
