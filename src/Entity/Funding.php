<?php

namespace App\Entity;

use App\Repository\FundingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FundingRepository::class)]
class Funding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fundings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $contact = null;

    #[ORM\Column]
    private ?int $grantFunding = null;

    #[ORM\OneToOne(mappedBy: 'fundingGeneralInfo', cascade: ['persist', 'remove'])]
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

    public function getGrantFunding(): ?int
    {
        return $this->grantFunding;
    }

    public function setGrantFunding(int $grantFunding): self
    {
        $this->grantFunding = $grantFunding;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        // unset the owning side of the relation if necessary
        if ($project === null && $this->project !== null) {
            $this->project->setFundingGeneralInfo(null);
        }

        // set the owning side of the relation if necessary
        if ($project !== null && $project->getFundingGeneralInfo() !== $this) {
            $project->setFundingGeneralInfo($this);
        }

        $this->project = $project;

        return $this;
    }
}
