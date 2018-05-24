<?php

namespace AppVerk\SectionBundle\Form\Handler;

use AppVerk\Components\Form\Handler\AbstractFormHandler;
use AppVerk\SectionBundle\Doctrine\SectionManager;
use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Service\SectionFieldsBuilder;

class SectionFormHandler extends AbstractFormHandler
{
    /** @var SectionManager */
    private $sectionManager;

    /** @var  SectionFieldsBuilder */
    private $sectionFieldsBuilder;

    public function __construct(SectionManager $sectionManager, SectionFieldsBuilder $sectionFieldsBuilder)
    {
        $this->sectionManager = $sectionManager;
        $this->sectionFieldsBuilder = $sectionFieldsBuilder;
    }

    protected function success()
    {
        /** @var Section $section */
        $section = $this->form->getData();
        $currentLocale = $section->getCurrentLocale();
        $requestData = $this->request->request->all();

        $section->setCustom(true);

        $section->translate($section->getCurrentLocale(), false)->setTitle($requestData['section']['title']);

        $theme = $requestData['section']['theme'] ? $requestData['section']['theme'] : null;
        $section->translate($section->getCurrentLocale(), false)->setTheme($theme);

        $this->sectionManager->persist($section);
        $section->setCurrentLocale($currentLocale);
        $section->mergeNewTranslations();

        if (!$section->getId()) {
            $this->sectionFieldsBuilder->buildSectionFields($section, $currentLocale);
        }

        $this->sectionManager->flush();

        return true;
    }

}
