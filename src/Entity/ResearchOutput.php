<?php

namespace App\Entity;

use App\Repository\ResearchOutputRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResearchOutputRepository::class)]
class ResearchOutput
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $identifier = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $standardUsed = null;

    #[ORM\Column]
    private ?bool $reused = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $lineage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $issued = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $language = null;

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'researchOutputs')]
    private Collection $contact;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $keyword = [];

    #[ORM\OneToMany(mappedBy: 'researchOutput', targetEntity: Cost::class)]
    private Collection $cost;

    #[ORM\ManyToOne(inversedBy: 'researchOutputs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Romp $romp = null;

    #[ORM\ManyToMany(targetEntity: VocabularyInfo::class, mappedBy: 'researchOutputs')]
    private Collection $vocabularyInfos;

    #[ORM\OneToMany(mappedBy: 'researchOutput', targetEntity: MetadataInfo::class)]
    private Collection $metadataInfos;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'researchOutputs')]
    private Collection $researchOutputs;



    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->cost = new ArrayCollection();
        $this->vocabularyInfos = new ArrayCollection();
        $this->metadataInfos = new ArrayCollection();
        $this->researchOutputs = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): self
    {
        $this->identifier = $identifier;

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

    public function getStandardUsed(): ?string
    {
        return $this->standardUsed;
    }

    public function setStandardUsed(?string $standardUsed): self
    {
        $this->standardUsed = $standardUsed;

        return $this;
    }

    public function isReused(): ?bool
    {
        return $this->reused;
    }

    public function setReused(bool $reused): self
    {
        $this->reused = $reused;

        return $this;
    }

    public function getLineage(): ?string
    {
        return $this->lineage;
    }

    public function setLineage(?string $lineage): self
    {
        $this->lineage = $lineage;

        return $this;
    }

    public function getIssued(): ?\DateTimeInterface
    {
        return $this->issued;
    }

    public function setIssued(?\DateTimeInterface $issued): self
    {
        $this->issued = $issued;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contact->removeElement($contact);

        return $this;
    }

    public function getKeyword(): array
    {
        return $this->keyword;
    }

    public function setKeyword(?array $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return Collection<int, Cost>
     */
    public function getCost(): Collection
    {
        return $this->cost;
    }

    public function addCost(Cost $cost): self
    {
        if (!$this->cost->contains($cost)) {
            $this->cost[] = $cost;
            $cost->setResearchOutput($this);
        }

        return $this;
    }

    public function removeCost(Cost $cost): self
    {
        if ($this->cost->removeElement($cost)) {
            // set the owning side to null (unless already changed)
            if ($cost->getResearchOutput() === $this) {
                $cost->setResearchOutput(null);
            }
        }

        return $this;
    }

    public function getRomp(): ?Romp
    {
        return $this->romp;
    }

    public function setRomp(?Romp $romp): self
    {
        $this->romp = $romp;

        return $this;
    }

    /**
     * @return Collection<int, VocabularyInfo>
     */
    public function getVocabularyInfos(): Collection
    {
        return $this->vocabularyInfos;
    }

    public function addVocabularyInfo(VocabularyInfo $vocabularyInfo): self
    {
        if (!$this->vocabularyInfos->contains($vocabularyInfo)) {
            $this->vocabularyInfos[] = $vocabularyInfo;
            $vocabularyInfo->addResearchOutput($this);
        }

        return $this;
    }

    public function removeVocabularyInfo(VocabularyInfo $vocabularyInfo): self
    {
        if ($this->vocabularyInfos->removeElement($vocabularyInfo)) {
            $vocabularyInfo->removeResearchOutput($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MetadataInfo>
     */
    public function getMetadataInfos(): Collection
    {
        return $this->metadataInfos;
    }

    public function addMetadataInfo(MetadataInfo $metadataInfo): self
    {
        if (!$this->metadataInfos->contains($metadataInfo)) {
            $this->metadataInfos[] = $metadataInfo;
            $metadataInfo->setResearchOutput($this);
        }

        return $this;
    }

    public function removeMetadataInfo(MetadataInfo $metadataInfo): self
    {
        if ($this->metadataInfos->removeElement($metadataInfo)) {
            // set the owning side to null (unless already changed)
            if ($metadataInfo->getResearchOutput() === $this) {
                $metadataInfo->setResearchOutput(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getResearchOutputs(): Collection
    {
        return $this->researchOutputs;
    }

    public function addResearchOutput(self $researchOutput): self
    {
        if (!$this->researchOutputs->contains($researchOutput)) {
            $this->researchOutputs[] = $researchOutput;
        }

        return $this;
    }

    public function removeResearchOutput(self $researchOutput): self
    {
        $this->researchOutputs->removeElement($researchOutput);

        return $this;
    }


}
