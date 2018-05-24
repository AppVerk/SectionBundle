<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldPhoto;

class FieldPhotoFactory extends AbstractFieldFactory
{
    public function createField(array $options): Field
    {
        return $this->setBasicData(new FieldPhoto(), $options);
    }

    public function getOptions()
    {
        return [
            'title' => '',
            'name'  => 'name',
        ];
    }
}
