<?php

namespace AppVerk\SectionBundle\Model\Standard;

use AppVerk\Components\Doctrine\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Section implements EntityInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @var integer
     */
    private $position;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

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
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->custom = true;
    }

    /**
     * Add field
     *
     * @param Field $field
     *
     * @return Section
     */
    public function addField($field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     *
     * @param Field $field
     */
    public function removeField(Field $field)
    {
        $this->fields->removeElement($field);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFields()
    {
        return $this->fields;
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
