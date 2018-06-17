<?php

namespace AppVerk\SectionBundle\Form\Type;

use AppVerk\SectionBundle\Entity\SectionDefault;
use AppVerk\SectionBundle\Util\ConfigProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionDefaultEditFormType extends AbstractType
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function __construct(ConfigProvider $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fields',
                CollectionType::class,
                [
                    'entry_type' => FieldType::class,
                    'allow_add'  => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'translation_domain' => 'form_section_type',
                'data_class'         => SectionDefault::class,
            ]
        );
    }
}
