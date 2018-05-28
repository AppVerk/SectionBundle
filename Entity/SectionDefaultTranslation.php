<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
class SectionDefaultTranslation implements EntityInterface
{
    use TimestampableEntity;
    use ORMBehaviors\Translatable\Translation;
    use NavigatedProperty;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
