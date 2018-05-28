<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldHTML;

class FieldHTMLFactory extends AbstractFieldFactory
{
    public function createField(array $options): Field
    {
        return $this->setBasicData(new FieldHTML(), $options);
    }

    public function getOptions()
    {
        return [
            'title' => '',
            'name'  => 'name',
        ];
    }
}
