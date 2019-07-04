<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="password",
 *         column=@ORM\Column(
 *             nullable=true
 *         )
 *     ),
 *     @ORM\AttributeOverride(name="username",
 *         column=@ORM\Column(
 *             nullable=true
 *         )
 *     ),
 *     @ORM\AttributeOverride(name="usernameCanonical",
 *         column=@ORM\Column(
 *             name="username_canonical",
 *             nullable=true
 *         )
 *     )
 * })
 */
class User extends BaseUser
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $smartphoneId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEligible;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $apiToken;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Job")
     * @ORM\JoinColumn(nullable=false)
     */
    private $job;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getIsEligible(): ?bool
    {
        return $this->isEligible;
    }

    public function setIsEligible(bool $isEligible): self
    {
        $this->isEligible = $isEligible;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmartphoneId()
    {
        return $this->smartphoneId;
    }

    /**
     * @param mixed $smartphoneId
     */
    public function setSmartphoneId($smartphoneId): void
    {
        $this->smartphoneId = $smartphoneId;
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

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken): void
    {
        $this->apiToken = $apiToken;
    }


}