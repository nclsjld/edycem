<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
 */
class Settings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $rgpd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRgpd(): ?string
    {
        return $this->rgpd;
    }

    public function setRgpd(string $rgpd): self
    {
        $this->rgpd = $rgpd;

        return $this;
    }
}
