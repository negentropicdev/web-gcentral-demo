<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageRepository::class)
 */
class Package
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $version;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity=PackageRating::class, mappedBy="package")
     */
    private $ratings;

    /**
     * @ORM\ManyToMany(targetEntity=DeveloperGroup::class, mappedBy="packages")
     */
    private $developers;

    /**
     * @ORM\Column(type="integer")
     */
    private $downloads;

    /**
     * @ORM\Column(type="float")
     */
    private $avg_rating;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
        $this->developers = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|PackageRating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(PackageRating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setPackage($this);
        }

        return $this;
    }

    public function removeRating(PackageRating $rating): self
    {
        if ($this->ratings->contains($rating)) {
            $this->ratings->removeElement($rating);
            // set the owning side to null (unless already changed)
            if ($rating->getPackage() === $this) {
                $rating->setPackage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DeveloperGroup[]
     */
    public function getDevelopers(): Collection
    {
        return $this->developers;
    }

    public function addDeveloper(DeveloperGroup $developer): self
    {
        if (!$this->developers->contains($developer)) {
            $this->developers[] = $developer;
            $developer->addPackage($this);
        }

        return $this;
    }

    public function removeDeveloper(DeveloperGroup $developer): self
    {
        if ($this->developers->contains($developer)) {
            $this->developers->removeElement($developer);
            $developer->removePackage($this);
        }

        return $this;
    }

    public function getDownloads(): ?int
    {
        return $this->downloads;
    }

    public function setDownloads(int $downloads): self
    {
        $this->downloads = $downloads;

        return $this;
    }

    public function getAvgRating(): ?float
    {
        return $this->avg_rating;
    }

    public function setAvgRating(float $avg_rating): self
    {
        $this->avg_rating = $avg_rating;

        return $this;
    }
}
