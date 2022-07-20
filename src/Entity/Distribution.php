<?php

namespace App\Entity;

use App\Repository\DistributionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistributionRepository::class)]
class Distribution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, columnDefinition:"TEXT CHECK (size_unit IN ('Ko', 'Mo', 'Go', 'To', 'Po'))",
    nullable:true)]
    private ?string $sizeUnit = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $accessUrl = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $accessProtocol = null;

    #[ORM\Column(nullable: true)]
    private ?int $sizeValue = null;

    #[ORM\Column(type: Types::TEXT, columnDefinition:"TEXT CHECK (access IN ('open default', 'onDemand', 'embargo'))",
    nullable:true)]
    private ?string $access = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $format = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $downloadUrl = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Embargo $embargo = null;

    #[ORM\ManyToOne(inversedBy: 'distributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Licence $licence = null;

    #[ORM\ManyToOne(inversedBy: 'distributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Host $host = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccess(): ?string
    {
        return $this->access;
    }

    public function setAccess(?string $access): self
    {
        $this->access = $access;

        return $this;
    }

    public function getAccessUrl(): ?string
    {
        return $this->accessUrl;
    }

    public function setAccessUrl(string $accessUrl): self
    {
        $this->accessUrl = $accessUrl;

        return $this;
    }

    public function getAccessProtocol(): ?string
    {
        return $this->accessProtocol;
    }

    public function setAccessProtocol(string $accessProtocol): self
    {
        $this->accessProtocol = $accessProtocol;

        return $this;
    }

    public function getSizeValue(): ?int
    {
        return $this->sizeValue;
    }

    public function setSizeValue(?int $sizeValue): self
    {
        $this->sizeValue = $sizeValue;

        return $this;
    }

    public function getSizeUnit(): ?string
    {
        return $this->sizeUnit;
    }

    public function setSizeUnit(?string $sizeUnit): self
    {
        $this->sizeUnit = $sizeUnit;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }

    public function setDownloadUrl(?string $downloadUrl): self
    {
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    public function getEmbargo(): ?Embargo
    {
        return $this->embargo;
    }

    public function setEmbargo(?Embargo $embargo): self
    {
        $this->embargo = $embargo;

        return $this;
    }

    public function getLicence(): ?Licence
    {
        return $this->licence;
    }

    public function setLicence(?Licence $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): self
    {
        $this->host = $host;

        return $this;
    }
}
