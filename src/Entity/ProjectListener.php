<?php

namespace App\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

class ProjectListener
{
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(Project $project, PreUpdateEventArgs $eventArgs)
    {
        if ($eventArgs->getEntity() instanceof Project) {
            if ($eventArgs->hasChangedField('isValidate') && $eventArgs->getNewValue('isValidate') === true) {
                $project->setCreatedAt(new \DateTime(date("Y-m-d H:i:s")));
            }
        }
    }
}
