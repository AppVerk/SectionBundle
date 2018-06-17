<?php

namespace AppVerk\SectionBundle\Form\Extender;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

class FieldInputExtender implements FieldFormExtenderInterface
{
    public static function addChildren(FormInterface $form, $object)
    {
        $form->add(
            'text',
            TextType::class,
            [
                'label' => false,
            ]
        );
    }
}
