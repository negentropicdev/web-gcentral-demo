<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $displayName;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity=PackageRating::class, mappedBy="user")
     */
    private $packageRatings;

    /**
     * @ORM\ManyToMany(targetEntity=PackageDeveloper::class, mappedBy="users")
     */
    private $packageDevelopers;

    public function __construct()
    {
        $this->packageRatings = new ArrayCollection();
        $this->packageDevelopers = new ArrayCollection();
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
    public function getUsername(): string
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|PackageRating[]
     */
    public function getPackageRatings(): Collection
    {
        return $this->packageRatings;
    }

    public function addPackageRating(PackageRating $packageRating): self
    {
        if (!$this->packageRatings->contains($packageRating)) {
            $this->packageRatings[] = $packageRating;
            $packageRating->setUser($this);
        }

        return $this;
    }

    public function removePackageRating(PackageRating $packageRating): self
    {
        if ($this->packageRatings->contains($packageRating)) {
            $this->packageRatings->removeElement($packageRating);
            // set the owning side to null (unless already changed)
            if ($packageRating->getUser() === $this) {
                $packageRating->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PackageDeveloper[]
     */
    public function getPackageDevelopers(): Collection
    {
        return $this->packageDevelopers;
    }

    public function addPackageDeveloper(PackageDeveloper $packageDeveloper): self
    {
        if (!$this->packageDevelopers->contains($packageDeveloper)) {
            $this->packageDevelopers[] = $packageDeveloper;
            $packageDeveloper->addUser($this);
        }

        return $this;
    }

    public function removePackageDeveloper(PackageDeveloper $packageDeveloper): self
    {
        if ($this->packageDevelopers->contains($packageDeveloper)) {
            $this->packageDevelopers->removeElement($packageDeveloper);
            $packageDeveloper->removeUser($this);
        }

        return $this;
    }
}
