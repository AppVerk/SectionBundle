<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
class FieldInputTranslation implements EntityInterface
{
    use TimestampableEntity;
    use ORMBehaviors\Translatable\Translation;
    use BasicFieldTypeTranslation;

    /**
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}
