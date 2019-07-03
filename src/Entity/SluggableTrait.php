<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;

Trait SluggableTrait
{
	/**
	 * @Gedmo\Slug(fields={"name"}, updatable=false)
	 * @ORM\Column(length=255, unique=true)
	 */
	protected $slug;

	public function getSlug()
	{
		return $this->slug;
	}

	public function setSlug($slug)
	{
		$this->slug = $slug;
	}
}