<?php

namespace AppVerk\SectionBundle\Form\Extender;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;

class FieldCheckboxExtender implements FieldFormExtenderInterface
{
    public static function addChildren(FormInterface $form, $object)
    {
        $form->add(
            'selected',
            CheckboxType::class,
            [
                'label'    => $object->getName(),
                'required' => false,
            ]
        );
    }
}
