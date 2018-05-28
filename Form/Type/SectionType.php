<?php

namespace AppVerk\SectionBundle\Form\Type;

use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Util\ConfigProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $builder
            ->add('title')
            ->add('submit', SubmitType::class);
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
