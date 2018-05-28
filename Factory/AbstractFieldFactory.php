<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;

abstract class AbstractFieldFactory
{
    protected function setBasicData(Field $field, $options)
    {
        $field->setSettings((bool)$options['settings']);
        $field->setName($options['name']);

        return $field;
    }

    abstract public function createField(array $options): Field;

    abstract public function getOptions();
}
