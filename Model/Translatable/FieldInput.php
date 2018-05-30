<?php

namespace AppVerk\SectionBundle\Model\Translatable;

use AppVerk\Components\Doctrine\TranslatableSupportTrait;
use AppVerk\Components\Doctrine\TranslationEntityInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

class FieldInput extends Field implements TranslationEntityInterface
{
    use TranslatableSupportTrait;
    use ORMBehaviors\Translatable\Translatable;

    const TYPE_INPUT = 'input';

    public function __construct()
    {
        $this->type = self::TYPE_INPUT;
    }
}
