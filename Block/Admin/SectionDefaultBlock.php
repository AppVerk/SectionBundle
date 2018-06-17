<?php

namespace AppVerk\SectionBundle\Block\Admin;

use AppVerk\BlockBundle\Block\AbstractBlock;
use AppVerk\SectionBundle\Form\Handler\SectionDefaultEditFormHandler;
use AppVerk\SectionBundle\Form\Type\SectionDefaultEditFormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionDefaultBlock extends AbstractBlock
{
    /**
     * @var SectionDefaultEditFormHandler
     */
    private $formHandler;

    /**
     * @required
     */
    public function setFormHandler(SectionDefaultEditFormHandler $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    public function execute(array $options = [])
    {
        $settings = $this->getSettings($options);

        $from = $this->formHandler->buildForm(SectionDefaultEditFormType::class, $settings['section']);

        return $this->renderResponse(
            $settings['template'],
            [
                'section'   => $settings['section'],
                'lang'      => $settings['lang'],
                'remove_id' => $settings['remove_id'],
                'form'      => $from->getFormView(),
            ]
        );
    }

    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            [
                'template'  => 'SectionBundle:Block/Admin:default.html.twig',
                'section'   => null,
                'form'      => null,
                'lang'      => null,
                'remove_id' => null,
            ]
        );
    }
}
