<?php

namespace App\Entity;

use App\Repository\EmbargoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmbargoRepository::class)]
class Embargo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $legalAndContractualReasons = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $intentionalRestrictions = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLegalAndContractualReasons(): ?string
    {
        return $this->legalAndContractualReasons;
    }

    public function setLegalAndContractualReasons(?string $legalAndContractualReasons): self
    {
        $this->legalAndContractualReasons = $legalAndContractualReasons;

        return $this;
    }

    public function getIntentionalRestrictions(): ?string
    {
        return $this->intentionalRestrictions;
    }

    public function setIntentionalRestrictions(?string $intentionalRestrictions): self
    {
        $this->intentionalRestrictions = $intentionalRestrictions;

        return $this;
    }
}
