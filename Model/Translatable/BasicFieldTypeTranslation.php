<?php

namespace AppVerk\SectionBundle\Model\Translatable;

trait BasicFieldTypeTranslation
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
}
