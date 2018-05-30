<?php

namespace AppVerk\SectionBundle\Model\Translatable;

class FieldCheckbox extends Field
{
    const TYPE_CHECKBOX = 'checkbox';

    /**
     * @var string
     */
    private $label;

    /**
     * @var boolean
     */
    private $checked;

    public function __construct()
    {
        $this->type = self::TYPE_CHECKBOX;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param mixed $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
    }
}
