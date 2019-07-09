<?php

namespace App\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository") @ORM\EntityListeners({"ProjectListener"})
 * @ORM\HasLifecycleCallbacks
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

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    public function getClaimantName()
    {
        return $this->claimantName;
    }

    public function setClaimantName($claimantName)
    {
        $this->claimantName = $claimantName;

        return $this;
    }

    public function getRelevantSite()
    {
        return $this->relevantSite;
    }

    public function setRelevantSite($relevantSite)
    {
        $this->relevantSite = $relevantSite;

        return $this;
    }

    public function getIsEligibleCIR()
    {
        return $this->isEligibleCIR;
    }

    public function setIsEligibleCIR($isEligibleCIR)
    {
        $this->isEligibleCIR = $isEligibleCIR;

        return $this;
    }

    public function getIsValidate()
    {
        return $this->isValidate;
    }

    public function setIsValidate($isValidate)
    {
        $this->isValidate = $isValidate;
    }

    public function getAsPartOfPulpit()
    {
        return $this->asPartOfPulpit;
    }

    public function setAsPartOfPulpit($asPartOfPulpit)
    {
        $this->asPartOfPulpit = $asPartOfPulpit;

        return $this;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getDocuments()
    {
        return $this->documents;
    }

    public function setDocuments($documents)
    {
        $this->documents = $documents;

        return $this;
    }

    public function getActivityType()
    {
        return $this->activityType;
    }

    public function setActivityType($activityType)
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
    public function setJob($job)
    {
        $this->job = $job;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetCreatedAt()
    {
        if(!$this->created_at){
            $this->created_at = new \DateTime();
        }
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function toJSON()
    {
        $vars = get_object_vars($this);
        $vars['job'] = $vars['job']->toJSON();
        $vars['deadline'] = get_object_vars($vars['deadline']);
        return $vars;
    }

}
