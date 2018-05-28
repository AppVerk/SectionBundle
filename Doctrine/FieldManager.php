<?php

namespace AppVerk\SectionBundle\Doctrine;

use AppVerk\Components\Doctrine\AbstractManager;
use AppVerk\Components\Doctrine\ManagerInterface;
use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\Section;

class FieldManager extends AbstractManager implements ManagerInterface
{
    public function removeTranslation(Field $field, $locale)
    {
        $translations = $field->getTranslations();
        foreach ($translations as $translation) {
            if ($translation->getLocale() === $locale) {
                $this->objectManager->remove($translation);
                $this->objectManager->flush();
            }
        }
        $this->objectManager->refresh($field);
        if ($field->getTranslations()->isEmpty()) {
            $this->remove($field);
        }

        return null;
    }

    public function getSectionField(Section $section, array $data)
    {
        return $this->getRepository()->getSectionField($section, $data);
    }
}
