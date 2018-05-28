<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\TranslatableSupportTrait;
use AppVerk\Components\Doctrine\TranslationEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
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
