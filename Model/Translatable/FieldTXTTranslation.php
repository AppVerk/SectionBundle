<?php

namespace AppVerk\SectionBundle\Model\Translatable;

use AppVerk\Components\Doctrine\EntityInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

class FieldTXTTranslation implements EntityInterface
{
    use ORMBehaviors\Translatable\Translation;
    use BasicFieldTypeTranslation;

    /**
     * @var string
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
