<?php

namespace AppVerk\SectionBundle\Entity;

use AppVerk\Components\Doctrine\TranslatableSupportTrait;
use AppVerk\Components\Doctrine\TranslationEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity()
 */
class SectionDefault extends Section implements TranslationEntityInterface, NavigatedInterface
{
    const TYPE_DEFAULT = 'default';

    use ORMBehaviors\Translatable\Translatable;
    use TranslatableSupportTrait;

    public function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE_DEFAULT;
    }
}
