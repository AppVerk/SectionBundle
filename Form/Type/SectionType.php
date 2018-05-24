<?php

namespace AppVerk\SectionBundle\Form\Type;

use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Util\ConfigProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
{
    /** @var  ConfigProvider */
    private $configProvider;

    public function __construct(ConfigProvider $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $object = $builder->getData();

        $configProvider = $this->configProvider;

        $builder
            ->add('title')
            ->add(
                'template',
                ChoiceType::class,
                [
                    'required'    => true,
                    'choices'     => $this->configProvider->getTemplates(),
                    'disabled'    => ($object->getId()) ? true : false,
                    'attr'        => [
                        'class' => 'image-picker show-html',
                    ],
                    'choice_attr' => function ($template, $key, $index) use ($configProvider) {
                        $templateSettings = $configProvider->getTemplateSettings($index);

                        return [
                            'data-preview-path' => '/'.$templateSettings['preview'],
                            'data-select'       => $index,
                            'data-img-src'      => '/'.$templateSettings['preview'],
                            'data-img-alt'      => $index,
                        ];
                    },
                ]
            )
            ->add(
                'theme',
                ChoiceType::class,
                ['required' => false, 'choices' => $this->configProvider->getSectionThemes()]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => Section::class,
                'translation_domain' => 'form_section_type',
                'csrf_protection'    => false,
            ]
        );
    }
}
