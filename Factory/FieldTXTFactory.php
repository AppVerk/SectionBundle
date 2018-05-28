<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldTXT;

class FieldTXTFactory extends AbstractFieldFactory
{
    public function createField(array $options): Field
    {
        return $this->setBasicData(new FieldTXT(), $options);
    }

    public function getOptions()
    {
        return [
            'title' => '',
            'name'  => 'name',
        ];
    }
}
