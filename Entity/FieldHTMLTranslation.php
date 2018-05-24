<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
class FieldHTMLTranslation implements EntityInterface
{
    use TimestampableEntity;
    use ORMBehaviors\Translatable\Translation;
    use BasicFieldTypeTranslation;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}
