<?php

namespace AppVerk\SectionBundle\Model\Translatable;

class FieldChoice extends Field
{
    const TYPE_CHOICE = 'choice';

    const CONTROL_SELECT = 'select';
    const CONTROL_RADIO = 'radio';

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $control;

    /**
     * @var array
     */
    private $options;

    public function __construct()
    {
        $this->type = self::TYPE_CHOICE;
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
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getControl()
    {
        return $this->control;
    }

    /**
     * @param mixed $control
     */
    public function setControl($control)
    {
        $this->control = $control;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
