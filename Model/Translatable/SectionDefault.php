<?php

namespace AppVerk\SectionBundle\Model\Translatable;

use AppVerk\Components\Doctrine\TranslationEntityInterface;

class SectionDefault extends Section implements TranslationEntityInterface
{
    const TYPE_DEFAULT = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE_DEFAULT;
    }

    public function getTranslations()
    {
    }

    public function getCurrentLocale()
    {
    }

    public function translate($locale = null, $fallbackToDefault = true)
    {
    }
}
