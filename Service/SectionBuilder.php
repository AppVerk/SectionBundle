<?php

namespace AppVerk\SectionBundle\Service;

use Appverk\Components\Doctrine\TranslationEntityInterface;
use AppVerk\SectionBundle\Doctrine\FieldManager;
use AppVerk\SectionBundle\Doctrine\SectionManager;
use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldHTML;
use AppVerk\SectionBundle\Entity\FieldInput;
use AppVerk\SectionBundle\Entity\FieldTXT;
use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Factory\AbstractFieldFactory;
use AppVerk\SectionBundle\Util\ConfigProvider;

class SectionBuilder
{
    /** @var  ConfigProvider */
    private $configProvider;

    /** @var  FieldManager */
    private $fieldManager;
    /**
     * @var SectionManager
     */
    private $sectionManager;
    private $locale;

    public function __construct(
        ConfigProvider $configProvider,
        FieldManager $fieldManager,
        SectionManager $sectionManager,
        $locale
    ) {
        $this->configProvider = $configProvider;
        $this->fieldManager = $fieldManager;
        $this->sectionManager = $sectionManager;
        $this->locale = $locale;
    }

    public function buildSections()
    {
        $sectionsConfig = $this->configProvider->getSectionSettings();
        $position = 1;

        foreach ($sectionsConfig as $name => $sectionConfig) {
            $existingSection = $this->sectionManager->getRepository()->findOneBy(['name' => $name]);

            if ($existingSection) {
                continue;
            }
            $sectionClass = $sectionConfig['model'];

            /** @var Section $section */
            $section = new $sectionClass();
            $section->setPosition($position);
            $section->setName($name);

            if ($section instanceof TranslationEntityInterface) {
                $section->translate($this->locale, false)->setTitle($sectionConfig['name']);

                if ($this->configProvider->isTranslatableEnabled() === true) {
                    $languages = $this->configProvider->getLanguages();
                    foreach ($languages as $language) {
                        $section->translate($language['code'], false)->setTitle($sectionConfig['name']);
                    }
                }
                $section->mergeNewTranslations();
                $this->sectionManager->persist($section);
            }
            $this->buildSectionFields($section, $sectionConfig['fields'], $sectionConfig['name']);

            $position++;
        }
        $this->sectionManager->flush();

        return true;
    }

    public function buildSectionFields(Section $section, $fields = null, $sectionName)
    {
        if ($fields === null) {
            $fields = $this->configProvider->getSectionFields($section->getName());
        }

        foreach ($fields as $fieldData) {
            $isFieldExist = $this->isFieldExists($section, $fieldData);
            if ($isFieldExist === true) {
                continue;
            }
            $fieldConfig = $this->configProvider->getFieldDefinition($fieldData['type']);

            $factoryClass = $fieldConfig['factory'];
            /** @var AbstractFieldFactory $factory */
            $factory = new $factoryClass();
            if (!$factory instanceof AbstractFieldFactory) {
                throw new \Exception(
                    "$factoryClass must extend AppVerk\SectionBundle\Entity\AbstractFieldFactory::class"
                );
            }
            $field = $factory->createField($fieldData);
            $field->setSection($section);
            $section->addField($field);

            if ($field instanceof TranslationEntityInterface) {
                $this->translateField($field, $sectionName, null, $fieldData, [['code' => $this->locale]]);
                if ($this->configProvider->isTranslatableEnabled() === true) {
                    $languages = $this->configProvider->getLanguages();
                    $this->translateField($field, $sectionName, $this->locale, $fieldData, $languages);
                }

                $field->mergeNewTranslations();
            }

            $this->fieldManager->persist($section);
            $this->fieldManager->persist($field);
        }
    }

    private function translateField(
        Field $field,
        string $sectionName,
        $currentLocale,
        array $data,
        array $languages = []
    ) {
        if (count($languages) > 0) {
            foreach ($languages as $language) {
                $currentLocale = $language['code'];
                $this->translateForLanguage($field, $sectionName, $currentLocale, $data);
            }
        } else {
            $this->translateForLanguage($field, $sectionName, $currentLocale, $data);
        }
    }

    private function translateForLanguage(Field $field, string $sectionName, $currentLocale, array $data)
    {
        $field->translate($currentLocale)->setTitle($data['title']);
        if ($field instanceof FieldTXT || $field instanceof FieldHTML) {
            $field->translate($currentLocale)->setBody($sectionName);
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
