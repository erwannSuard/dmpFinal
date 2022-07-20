<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $affiliation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $laboratoryOrDepartment = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $identifier = null;

    #[ORM\Column(length: 255)]
    private ?string $roleContact = null;

    #[ORM\OneToMany(mappedBy: 'fundedBy', targetEntity: Cost::class)]
    private Collection $hasFunded;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Funding::class)]
    private Collection $fundings;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'contact')]
    private Collection $projects;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Romp::class)]
    private Collection $romps;

    #[ORM\ManyToMany(targetEntity: ResearchOutput::class, mappedBy: 'contact')]
    private Collection $researchOutputs;

    public function __construct()
    {
        $this->hasFunded = new ArrayCollection();
        $this->fundings = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->romps = new ArrayCollection();
        $this->researchOutputs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getLaboratoryOrDepartment(): ?string
    {
        return $this->laboratoryOrDepartment;
    }

    public function setLaboratoryOrDepartment(?string $laboratoryOrDepartment): self
    {
        $this->laboratoryOrDepartment = $laboratoryOrDepartment;

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

    public function getRoleContact(): ?string
    {
        return $this->roleContact;
    }

    public function setRoleContact(string $roleContact): self
    {
        $this->roleContact = $roleContact;

        return $this;
    }

    /**
     * @return Collection<int, Cost>
     */
    public function getHasFunded(): Collection
    {
        return $this->hasFunded;
    }

    public function addHasFunded(Cost $hasFunded): self
    {
        if (!$this->hasFunded->contains($hasFunded)) {
            $this->hasFunded[] = $hasFunded;
            $hasFunded->setFundedBy($this);
        }

        return $this;
    }

    public function removeHasFunded(Cost $hasFunded): self
    {
        if ($this->hasFunded->removeElement($hasFunded)) {
            // set the owning side to null (unless already changed)
            if ($hasFunded->getFundedBy() === $this) {
                $hasFunded->setFundedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Funding>
     */
    public function getFundings(): Collection
    {
        return $this->fundings;
    }

    public function addFunding(Funding $funding): self
    {
        if (!$this->fundings->contains($funding)) {
            $this->fundings[] = $funding;
            $funding->setContact($this);
        }

        return $this;
    }

    public function removeFunding(Funding $funding): self
    {
        if ($this->fundings->removeElement($funding)) {
            // set the owning side to null (unless already changed)
            if ($funding->getContact() === $this) {
                $funding->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addContact($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeContact($this);
        }

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
            $romp->setContact($this);
        }

        return $this;
    }

    public function removeRomp(Romp $romp): self
    {
        if ($this->romps->removeElement($romp)) {
            // set the owning side to null (unless already changed)
            if ($romp->getContact() === $this) {
                $romp->setContact(null);
            }
        }

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
            $researchOutput->addContact($this);
        }

        return $this;
    }

    public function removeResearchOutput(ResearchOutput $researchOutput): self
    {
        if ($this->researchOutputs->removeElement($researchOutput)) {
            $researchOutput->removeContact($this);
        }

        return $this;
    }
}
