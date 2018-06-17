<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldCheckbox;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;

class FieldCheckboxFactory extends AbstractFieldFactory
{
    public function createField(array $options): Field
    {
        /** @var FieldCheckbox $field */
        $field = $this->setBasicData(new FieldCheckbox(), $options);
        $field->setLabel($options['label']);

        return $field;
    }

    public function getOptions()
    {
        return ["label", "name"];
    }
}
