<?php

namespace AppVerk\SectionBundle\Form\Type;

use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldCheckbox;
use AppVerk\SectionBundle\Entity\FieldHTML;
use AppVerk\SectionBundle\Entity\FieldInput;
use AppVerk\SectionBundle\Entity\FieldTXT;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $object = $builder->getData();

        if ($object instanceof FieldHTML) {
            $builder->add(
                'body',
                TextareaType::class,
                [
                    'label' => false,
                ]
            );
        }

        if ($object instanceof FieldCheckbox) {
            $builder->add(
                'selected',
                CheckboxType::class,
                [
                    'label'    => $object->getName(),
                    'required' => false,
                ]
            );
        }

        if ($object instanceof FieldTXT) {
            $builder->add(
                'body',
                TextareaType::class,
                [
                    'label' => false,
                    'attr'  => [
                        'style' => 'height:250px; resize: none;',
                    ],
                ]
            );
        }

        if ($object instanceof FieldInput) {
            $builder->add(
                'text',
                TextType::class,
                [
                    'label' => false,
                ]
            );
        }
        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => Field::class,
                'translation_domain' => 'messages',
                'csrf_protection'    => false,
            ]
        );
    }
}
