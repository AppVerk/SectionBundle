<?php

namespace AppVerk\SectionBundle\Form\Extender;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;

class FieldChoiceExtender implements FieldFormExtenderInterface
{
    public static function addChildren(FormInterface $form, $object)
    {
        $form->add(
            'value',
            ChoiceType::class,
            [
                'choices' => $object->getOptions()
            ]
        );
    }
}
