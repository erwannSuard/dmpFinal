<?php

namespace App\Entity;

use App\Repository\DataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRepository::class)]
class Data
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $sensitiveData = null;

    #[ORM\Column]
    private ?bool $personnalData = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $dataSecurity = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ResearchOutput $researchOutput = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSensitiveData(): ?bool
    {
        return $this->sensitiveData;
    }

    public function setSensitiveData(bool $sensitiveData): self
    {
        $this->sensitiveData = $sensitiveData;

        return $this;
    }

    public function isPersonnalData(): ?bool
    {
        return $this->personnalData;
    }

    public function setPersonnalData(bool $personnalData): self
    {
        $this->personnalData = $personnalData;

        return $this;
    }

    public function getDataSecurity(): ?string
    {
        return $this->dataSecurity;
    }

    public function setDataSecurity(?string $dataSecurity): self
    {
        $this->dataSecurity = $dataSecurity;

        return $this;
    }

    public function getResearchOutput(): ?ResearchOutput
    {
        return $this->researchOutput;
    }

    public function setResearchOutput(ResearchOutput $researchOutput): self
    {
        $this->researchOutput = $researchOutput;

        return $this;
    }
}
