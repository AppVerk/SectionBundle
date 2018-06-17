<?php

namespace AppVerk\SectionBundle\Form\Extender;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;

class FieldHTMLExtender implements FieldFormExtenderInterface
{
    public static function addChildren(FormInterface $form, $object)
    {
        $form->add(
            'body',
            TextareaType::class,
            [
                'label'         => false,
                'property_path' => 'body',
                'attr'          => [
                    'class' => 'redactor',
                ],
            ]
        );
    }
}
