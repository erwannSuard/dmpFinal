<?php

namespace App\Entity;

use App\Repository\MetadataInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetadataInfoRepository::class)]
class MetadataInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $standardName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $api = null;

    #[ORM\ManyToOne(inversedBy: 'metadataInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ResearchOutput $researchOutput = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStandardName(): ?string
    {
        return $this->standardName;
    }

    public function setStandardName(?string $standardName): self
    {
        $this->standardName = $standardName;

        return $this;
    }

    public function getApi(): ?string
    {
        return $this->api;
    }

    public function setApi(string $api): self
    {
        $this->api = $api;

        return $this;
    }

    public function getResearchOutput(): ?ResearchOutput
    {
        return $this->researchOutput;
    }

    public function setResearchOutput(?ResearchOutput $researchOutput): self
    {
        $this->researchOutput = $researchOutput;

        return $this;
    }
}
