<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $claimantName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $relevantSite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEligibleCIR;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValidate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asPartOfPulpit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deadline;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $documents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activityType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Job")
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getClaimantName(): ?string
    {
        return $this->claimantName;
    }

    public function setClaimantName(string $claimantName): self
    {
        $this->claimantName = $claimantName;

        return $this;
    }

    public function getRelevantSite(): ?string
    {
        return $this->relevantSite;
    }

    public function setRelevantSite(string $relevantSite): self
    {
        $this->relevantSite = $relevantSite;

        return $this;
    }

    public function getIsEligibleCIR(): ?bool
    {
        return $this->isEligibleCIR;
    }

    public function setIsEligibleCIR(bool $isEligibleCIR): self
    {
        $this->isEligibleCIR = $isEligibleCIR;

        return $this;
    }

    public function getisValidate()
    {
        return $this->isValidate;
    }

    public function setIsValidate($isValidate)
    {
        $this->isValidate = $isValidate;
    }

    public function getAsPartOfPulpit(): ?bool
    {
        return $this->asPartOfPulpit;
    }

    public function setAsPartOfPulpit(bool $asPartOfPulpit): self
    {
        $this->asPartOfPulpit = $asPartOfPulpit;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function setDocuments(string $documents): self
    {
        $this->documents = $documents;

        return $this;
    }

    public function getActivityType(): ?string
    {
        return $this->activityType;
    }

    public function setActivityType(string $activityType): self
    {
        $this->activityType = $activityType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param mixed $job
     */
    public function setJob($job): void
    {
        $this->job = $job;
    }

}
