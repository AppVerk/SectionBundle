<?php

namespace AppVerk\SectionBundle\Model\Standard;

use AppVerk\Components\Doctrine\EntityInterface;

abstract class Field implements EntityInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Section
     */
    private $section;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    private $settings = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Set section
     *
     * @param Section $section
     *
     * @return Field
     */
    public function setSection(Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @return mixed
     */
    public function isSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
