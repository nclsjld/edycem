<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

Trait TimestampableTrait
{

	/**
	 * @var \DateTime $createdAt
	 *
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;

	/**
	 * @var \DateTime $updatedAt
	 *
	 * @ORM\Column(name="updated_at", type="datetime")
	 */
	private $updatedAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setCreatedAt(new \Datetime());
        $this->setUpdatedAt(new \Datetime());
    }


	/**
	 * Get createdAt
	 *
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
     * @return $this
     */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Set updatedAt
	 *
	 * @param \DateTime $updatedAt
     * @return $this
     */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}
}