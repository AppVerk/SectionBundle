<?php

namespace AppVerk\SectionBundle\Factory;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldChoice;

class FieldChoiceFactory extends AbstractFieldFactory
{
    const OPTION_TRUE = 'Yes';
    const OPTION_FALSE = 'No';

    public function createField(array $options): Field
    {
        /** @var FieldChoice $field */
        $field = $this->setBasicData(new FieldChoice(), $options);
        $field->setLabel($options['label']);
        $field->setOptions($options['options']);
        $field->setControl($options['control']);
        $field->setValue($options['options'][0]['value']);

        return $field;
    }

    public function getOptions()
    {
        return [
            'control'  => 'radio',
            'label'    => 'Choice value',
            'name'     => 'name',
            'settings' => true,
            'options'  => [
                self::OPTION_TRUE  => self::OPTION_TRUE,
                self::OPTION_FALSE => self::OPTION_FALSE,
            ],
        ];
    }
}
