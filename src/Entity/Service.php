<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $typeOfService = null;

    #[ORM\Column]
    private ?int $endProjectTrl = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ResearchOutput $researchOutput = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfService(): ?string
    {
        return $this->typeOfService;
    }

    public function setTypeOfService(string $typeOfService): self
    {
        $this->typeOfService = $typeOfService;

        return $this;
    }

    public function getEndProjectTrl(): ?int
    {
        return $this->endProjectTrl;
    }

    public function setEndProjectTrl(int $endProjectTrl): self
    {
        $this->endProjectTrl = $endProjectTrl;

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
