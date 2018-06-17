<?php

namespace AppVerk\SectionBundle\Form\Type;

use AppVerk\Components\Doctrine\TranslationEntityInterface;
use AppVerk\SectionBundle\Form\Extender\FieldFormExtenderInterface;
use AppVerk\SectionBundle\Util\ConfigProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldType extends AbstractType
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @required
     */
    public function setConfigProvider(ConfigProvider $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $configProvider = $this->configProvider;

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) use ($configProvider)  {
                $object = $event->getData();
                $form = $event->getForm();
                $owner = $event->getForm()->getParent()->getData()->getOwner();

                if($owner instanceof TranslationEntityInterface){
                    $object->setCurrentLocale($owner->getCurrentLocale());
                }

                $extender = $this->configProvider->getFieldExtender($object->getType());
                $interfaces = class_implements($extender);
                if(!isset($interfaces[FieldFormExtenderInterface::class])){
                    throw new \Exception("Class {$extender} needs to implement FieldFormExtenderInterface");
                }
                $extender::addChildren($form, $object);
            }
        );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'translation_domain' => 'messages',
                'csrf_protection'    => false,
            ]
        );
    }
}
