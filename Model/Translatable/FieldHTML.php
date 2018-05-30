<?php

namespace AppVerk\SectionBundle\Model\Translatable;

use AppVerk\Components\Doctrine\TranslatableSupportTrait;
use AppVerk\Components\Doctrine\TranslationEntityInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

class FieldHTML extends Field implements TranslationEntityInterface
{
    use TranslatableSupportTrait;
    use ORMBehaviors\Translatable\Translatable;

    const TYPE_HTML = 'html';

    public function __construct()
    {
        $this->type = self::TYPE_HTML;
    }
}
