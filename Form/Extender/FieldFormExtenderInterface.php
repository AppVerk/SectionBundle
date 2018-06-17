<?php

namespace AppVerk\SectionBundle\Form\Extender;

use Symfony\Component\Form\FormInterface;

interface FieldFormExtenderInterface
{
    public static function addChildren(FormInterface $form, $object);
}
