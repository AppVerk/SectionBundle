<?php

namespace AppVerk\SectionBundle\Model\Standard;

use AppVerk\Components\Doctrine\EntityInterface;

class SectionDefault extends Section implements EntityInterface
{
    const TYPE_DEFAULT = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->type = self::TYPE_DEFAULT;
    }

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
