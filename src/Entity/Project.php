<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'workPackages')]
    private ?self $parentProject = null;

    #[ORM\OneToMany(mappedBy: 'parentProject', targetEntity: self::class)]
    private Collection $workPackages;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $abstract = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $acronyme = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $objectives = null;

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'projects')]
    private Collection $contact;

    #[ORM\OneToOne(inversedBy: 'project', cascade: ['persist', 'remove'])]
    private ?Funding $fundingGeneralInfo = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Romp::class)]
    private Collection $romps;

    public function __construct()
    {
        $this->workPackages = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->romps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentProject(): ?self
    {
        return $this->parentProject;
    }

    public function setParentProject(?self $parentProject): self
    {
        $this->parentProject = $parentProject;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getWorkPackages(): Collection
    {
        return $this->workPackages;
    }

    public function addWorkPackage(self $workPackage): self
    {
        if (!$this->workPackages->contains($workPackage)) {
            $this->workPackages[] = $workPackage;
            $workPackage->setParentProject($this);
        }

        return $this;
    }

    public function removeWorkPackage(self $workPackage): self
    {
        if ($this->workPackages->removeElement($workPackage)) {
            // set the owning side to null (unless already changed)
            if ($workPackage->getParentProject() === $this) {
                $workPackage->setParentProject(null);
            }
        }

        return $this;
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

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getAcronyme(): ?string
    {
        return $this->acronyme;
    }

    public function setAcronyme(?string $acronyme): self
    {
        $this->acronyme = $acronyme;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getObjectives(): ?string
    {
        return $this->objectives;
    }

    public function setObjectives(?string $objectives): self
    {
        $this->objectives = $objectives;

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

    public function getFundingGeneralInfo(): ?Funding
    {
        return $this->fundingGeneralInfo;
    }

    public function setFundingGeneralInfo(?Funding $fundingGeneralInfo): self
    {
        $this->fundingGeneralInfo = $fundingGeneralInfo;

        return $this;
    }

    /**
     * @return Collection<int, Romp>
     */
    public function getRomps(): Collection
    {
        return $this->romps;
    }

    public function addRomp(Romp $romp): self
    {
        if (!$this->romps->contains($romp)) {
            $this->romps[] = $romp;
            $romp->setProject($this);
        }

        return $this;
    }

    public function removeRomp(Romp $romp): self
    {
        if ($this->romps->removeElement($romp)) {
            // set the owning side to null (unless already changed)
            if ($romp->getProject() === $this) {
                $romp->setProject(null);
            }
        }

        return $this;
    }
}
