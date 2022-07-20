<?php

namespace App\Entity;

use App\Repository\RompRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RompRepository::class)]
class Romp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'romps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $contact = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $identifier = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $submissionDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $version = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $deliverable = null;

    #[ORM\Column(type: Types::TEXT, columnDefinition:"TEXT CHECK (licence_romp IN ('CC-BY-4.0', 'CC-BY-NC-4.0', 'CC-BY--ND-4.0', 'CC-BY--SA-4.0', 'CC0-1.0'))",
    options: [
        "default" => "CC-BY-4.0"
            ])]
    private ?string $licence = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ethicalIssues = null;

    #[ORM\ManyToOne(inversedBy: 'romps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

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

    public function getSubmissionDate(): ?\DateTimeInterface
    {
        return $this->submissionDate;
    }

    public function setSubmissionDate(\DateTimeInterface $submissionDate): self
    {
        $this->submissionDate = $submissionDate;

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

    public function getDeliverable(): ?string
    {
        return $this->deliverable;
    }

    public function setDeliverable(string $deliverable): self
    {
        $this->deliverable = $deliverable;

        return $this;
    }

    public function getLicence(): ?string
    {
        return $this->licence;
    }

    public function setLicence(string $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getEthicalIssues(): ?string
    {
        return $this->ethicalIssues;
    }

    public function setEthicalIssues(?string $ethicalIssues): self
    {
        $this->ethicalIssues = $ethicalIssues;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
