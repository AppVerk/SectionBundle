<?php

namespace AppVerk\SectionBundle\Form\Handler;

use AppVerk\Components\Form\Handler\AbstractFormHandler;
use AppVerk\SectionBundle\Doctrine\SectionManager;
use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Service\SectionBuilder;
use AppVerk\SectionBundle\Util\ConfigProvider;

class SectionFormHandler extends AbstractFormHandler
{
    /** @var SectionManager */
    private $sectionManager;

    /** @var  SectionBuilder */
    private $sectionFieldsBuilder;
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function __construct(
        SectionManager $sectionManager,
        SectionBuilder $sectionFieldsBuilder,
        ConfigProvider $configProvider
    ) {
        $this->sectionManager = $sectionManager;
        $this->sectionFieldsBuilder = $sectionFieldsBuilder;
        $this->configProvider = $configProvider;
    }

    protected function success()
    {
        /** @var Section $section */
        $section = $this->form->getData();
        $currentLocale = $section->getCurrentLocale();
        $requestData = $this->request->request->all();

        $section->setName($this->configProvider->getSectionSetting('simple', 'name'));
        $section->translate($section->getCurrentLocale(), false)->setTitle($requestData['section']['title']);

        if ($this->configProvider->isTranslatableEnabled() === true && !$section->getId()) {
            $languages = $this->configProvider->getLanguages();
            foreach ($languages as $language) {
                if ($language['code'] !== $currentLocale) {
                    $section->translate($language['code'], false)->setTitle($requestData['section']['title']);
                }
            }
        }
        $this->sectionManager->persist($section);
        $section->setCurrentLocale($currentLocale);
        $section->mergeNewTranslations();

        if (!$section->getId()) {
            $this->sectionFieldsBuilder->buildSectionFields($section, null, $requestData['section']['title']);
        }

        $this->sectionManager->flush();

        return $section;
    }

}
