<?php

namespace AppVerk\SectionBundle\Doctrine;

use AppVerk\Components\Doctrine\AbstractManager;
use AppVerk\Components\Doctrine\ManagerInterface;
use AppVerk\SectionBundle\Entity\Section;

class SectionManager extends AbstractManager implements ManagerInterface
{
    public function removeTranslation(Section $field, $locale)
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

    public function updateSectionsOrder($data)
    {
        foreach ($data as $k => $id) {
            if (!empty($id)) {
                $section = $this->getRepository()->getOneById($id);
                if ($section) {
                    $section->setPosition($k);
                    $this->objectManager->persist($section);
                    $this->objectManager->flush();
                }
            }
        }
    }

    public function getAllSections($withNode = true)
    {
        return $this->getRepository()->getAllSections($withNode);
    }
}
