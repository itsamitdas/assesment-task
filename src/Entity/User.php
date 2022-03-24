<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\UserInputDto;
use App\Dto\UserOutputDto;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]

#[ApiResource(
    normalizationContext: ["groups" => ["user:read"]],
    denormalizationContext: ["groups" => ["user:write"]],
    output: UserOutputDto::class,
    input: UserInputDto::class,
)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Shop::class)]
    private $shops;

    #[ORM\Column(type: 'string', length: 50)]
    private $mobile;

    #[ORM\Column(type: 'text', nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    private $plainPassword;

    #[ORM\Column(type: 'boolean')]
    private $isActive = true;

    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: UserActivityLog::class, orphanRemoval: true)]
    private $userActivityLogs;

    public function __construct()
    {
        $this->shops = new ArrayCollection();
        $this->createdBy = new ArrayCollection();
        $this->userActivityLogs = new ArrayCollection();
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

    /**
     * @return Collection<int, Shop>
     */
    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function addShop(Shop $shop): self
    {
        if (!$this->shops->contains($shop)) {
            $this->shops[] = $shop;
            $shop->setUserId($this);
        }

        return $this;
    }

    public function removeShop(Shop $shop): self
    {
        if ($this->shops->removeElement($shop)) {
            // set the owning side to null (unless already changed)
            if ($shop->getUserId() === $this) {
                $shop->setUserId(null);
            }
        }

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
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

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, UserActivityLog>
     */
    public function getCreatedBy(): Collection
    {
        return $this->createdBy;
    }

    /**
     * @return Collection<int, UserActivityLog>
     */
    public function getUserActivityLogs(): Collection
    {
        return $this->userActivityLogs;
    }

    public function addUserActivityLog(UserActivityLog $userActivityLog): self
    {
        if (!$this->userActivityLogs->contains($userActivityLog)) {
            $this->userActivityLogs[] = $userActivityLog;
            $userActivityLog->setCreatedBy($this);
        }

        return $this;
    }

    public function removeUserActivityLog(UserActivityLog $userActivityLog): self
    {
        if ($this->userActivityLogs->removeElement($userActivityLog)) {
            // set the owning side to null (unless already changed)
            if ($userActivityLog->getCreatedBy() === $this) {
                $userActivityLog->setCreatedBy(null);
            }
        }

        return $this;
    }
}
