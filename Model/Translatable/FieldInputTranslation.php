<?php

namespace AppVerk\SectionBundle\Model\Translatable;

use AppVerk\Components\Doctrine\EntityInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

class FieldInputTranslation implements EntityInterface
{
    use ORMBehaviors\Translatable\Translation;
    use BasicFieldTypeTranslation;

    /**
     * @var string
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
