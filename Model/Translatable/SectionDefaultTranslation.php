<?php

namespace AppVerk\SectionBundle\Model\Translatable;

use AppVerk\Components\Doctrine\EntityInterface;

class SectionDefaultTranslation implements EntityInterface
{
    /**
     * @var string
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

    public function getId()
    {
    }
}
