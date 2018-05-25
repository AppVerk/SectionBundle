<?php

namespace AppVerk\SectionBundle\Service;

use Appverk\Components\Doctrine\TranslationEntityInterface;
use AppVerk\SectionBundle\Doctrine\FieldManager;
use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldHTML;
use AppVerk\SectionBundle\Entity\FieldInput;
use AppVerk\SectionBundle\Entity\FieldTXT;
use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Factory\AbstractFieldFactory;
use AppVerk\SectionBundle\Util\ConfigProvider;

class SectionFieldsBuilder
{
    /** @var  ConfigProvider */
    private $configProvider;

    /** @var  FieldManager */
    private $fieldManager;

    public function __construct(ConfigProvider $configProvider, FieldManager $fieldManager)
    {
        $this->configProvider = $configProvider;
        $this->fieldManager = $fieldManager;
    }

    public function buildSectionFields(Section $section, $currentLocale = null, array $languages = [])
    {
        $sectionTemplateName = $section->getTemplate();
        $sectionTemplate = $this->configProvider->getTemplateSettings($sectionTemplateName);

        if (count($sectionTemplate) > 0) {
            foreach ($sectionTemplate['fields'] as $data) {
                $isFieldExist = $this->isFieldExists($section, $data);
                if ($isFieldExist === true) {
                    continue;
                }
                $fieldConfig = $this->configProvider->getFieldDefinition($data['type']);

                $factoryClass = $fieldConfig['factory'];
                /** @var AbstractFieldFactory $factory */
                $factory = new $factoryClass();
                if (!$factory instanceof AbstractFieldFactory) {
                    throw new \Exception(
                        "$factoryClass must extend AppVerk\SectionBundle\Entity\AbstractFieldFactory::class"
                    );
                }
                $field = $factory->createField($data);
                $field->setSection($section);
                $section->addField($field);

                if ($field instanceof TranslationEntityInterface) {
                    $this->translateField($field, $sectionTemplateName, $currentLocale, $data, $languages);
                    $field->mergeNewTranslations();
                }

                $this->fieldManager->persist($section);
                $this->fieldManager->persist($field);
            }
        }
    }

    private function translateField(
        Field $field,
        string $sectionTemplateName,
        $currentLocale,
        array $data,
        array $languages = []
    ) {
        if (count($languages) > 0) {
            foreach ($languages as $language) {
                $currentLocale = $language['code'];
                $this->translateForLanguage($field, $sectionTemplateName, $currentLocale, $data);
            }
        } else {
            $this->translateForLanguage($field, $sectionTemplateName, $currentLocale, $data);
        }
    }

    private function translateForLanguage(Field $field, string $sectionTemplateName, $currentLocale, array $data)
    {
        $field->translate($currentLocale)->setTitle($data['title']);
        if ($field instanceof FieldTXT || $field instanceof FieldHTML) {
            $field->translate($currentLocale)->setBody($sectionTemplateName);
        }
        if ($field instanceof FieldInput) {
            $field->translate($currentLocale)->setText($data['text']);
        }
    }

    private function isFieldExists(Section $section, array $data): bool
    {
        $field = $section->getFields()->filter(
            function (Field $field) use ($data) {
                if ($field->getType() == $data['type'] && $field->getName() == $data['name']) {
                    return true;
                }

                return false;
            }
        );

        if ($field instanceof Field) {
            return true;
        }

        return false;
    }
}
