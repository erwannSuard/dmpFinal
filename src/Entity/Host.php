<?php

namespace App\Entity;

use App\Repository\HostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HostRepository::class)]
class Host
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $hostName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $hostDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $hostUrl = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $certifiedWith = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pidSystem = null;

    #[ORM\Column(nullable: true)]
    private ?bool $supportVersionning = null;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: Distribution::class)]
    private Collection $distributions;

    public function __construct()
    {
        $this->distributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHostName(): ?string
    {
        return $this->hostName;
    }

    public function setHostName(string $hostName): self
    {
        $this->hostName = $hostName;

        return $this;
    }

    public function getHostDescription(): ?string
    {
        return $this->hostDescription;
    }

    public function setHostDescription(string $hostDescription): self
    {
        $this->hostDescription = $hostDescription;

        return $this;
    }

    public function getHostUrl(): ?string
    {
        return $this->hostUrl;
    }

    public function setHostUrl(string $hostUrl): self
    {
        $this->hostUrl = $hostUrl;

        return $this;
    }

    public function getCertifiedWith(): ?string
    {
        return $this->certifiedWith;
    }

    public function setCertifiedWith(?string $certifiedWith): self
    {
        $this->certifiedWith = $certifiedWith;

        return $this;
    }

    public function getPidSystem(): ?string
    {
        return $this->pidSystem;
    }

    public function setPidSystem(?string $pidSystem): self
    {
        $this->pidSystem = $pidSystem;

        return $this;
    }

    public function isSupportVersionning(): ?bool
    {
        return $this->supportVersionning;
    }

    public function setSupportVersionning(?bool $supportVersionning): self
    {
        $this->supportVersionning = $supportVersionning;

        return $this;
    }

    /**
     * @return Collection<int, Distribution>
     */
    public function getDistributions(): Collection
    {
        return $this->distributions;
    }

    public function addDistribution(Distribution $distribution): self
    {
        if (!$this->distributions->contains($distribution)) {
            $this->distributions[] = $distribution;
            $distribution->setHost($this);
        }

        return $this;
    }

    public function removeDistribution(Distribution $distribution): self
    {
        if ($this->distributions->removeElement($distribution)) {
            // set the owning side to null (unless already changed)
            if ($distribution->getHost() === $this) {
                $distribution->setHost(null);
            }
        }

        return $this;
    }
}
