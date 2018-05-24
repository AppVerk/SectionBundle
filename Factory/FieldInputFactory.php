<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldInput;

class FieldInputFactory extends AbstractFieldFactory
{
    public function createField(array $options): Field
    {
        return $this->setBasicData(new FieldInput(), $options);
    }

    public function getOptions()
    {
        return [
            'title' => '',
            'name'  => 'name',
        ];
    }
}
