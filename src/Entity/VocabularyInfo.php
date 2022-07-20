<?php

namespace App\Entity;

use App\Repository\VocabularyInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VocabularyInfoRepository::class)]
class VocabularyInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $vocabularyName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $uri = null;

    #[ORM\ManyToMany(targetEntity: ResearchOutput::class, inversedBy: 'vocabularyInfos')]
    private Collection $researchOutputs;

    public function __construct()
    {
        $this->researchOutputs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVocabularyName(): ?string
    {
        return $this->vocabularyName;
    }

    public function setVocabularyName(?string $vocabularyName): self
    {
        $this->vocabularyName = $vocabularyName;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return Collection<int, ResearchOutput>
     */
    public function getResearchOutputs(): Collection
    {
        return $this->researchOutputs;
    }

    public function addResearchOutput(ResearchOutput $researchOutput): self
    {
        if (!$this->researchOutputs->contains($researchOutput)) {
            $this->researchOutputs[] = $researchOutput;
        }

        return $this;
    }

    public function removeResearchOutput(ResearchOutput $researchOutput): self
    {
        $this->researchOutputs->removeElement($researchOutput);

        return $this;
    }
}
