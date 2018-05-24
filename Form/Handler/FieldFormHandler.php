<?php

namespace AppVerk\SectionBundle\Form\Handler;

use AppVerk\Components\Doctrine\TranslationEntityInterface;
use AppVerk\Components\Form\Handler\AbstractFormHandler;
use AppVerk\SectionBundle\Doctrine\FieldManager;
use AppVerk\SectionBundle\Entity\FieldHTML;
use AppVerk\SectionBundle\Entity\FieldInput;
use AppVerk\SectionBundle\Entity\FieldPhoto;
use AppVerk\SectionBundle\Entity\FieldTXT;

class FieldFormHandler extends AbstractFormHandler
{
    /**
     * @var FieldManager
     */
    private $fieldManager;

    public function __construct(FieldManager $fieldManager)
    {
        $this->fieldManager = $fieldManager;
    }

    protected function success()
    {
        $field = $this->form->getData();
        $requestData = $this->request->request->all();

        if ($field instanceof FieldHTML || $field instanceof FieldTXT) {
            $field->translate($field->getCurrentLocale(), false)->setBody($requestData['field']['body']);
        } else {
            if ($field instanceof FieldInput) {
                $field->translate($field->getCurrentLocale(), false)->setText($requestData['field']['text']);
            } else {
                if ($field instanceof FieldPhoto) {
                    $field->translate($field->getCurrentLocale(), false)->setPhoto(
                        $this->form->get('photo')->getData()
                    );
                }
            }
        }

        $this->fieldManager->persist($field);
        if ($field instanceof TranslationEntityInterface) {
            $field->mergeNewTranslations();
        }

        $this->fieldManager->flush();

        return true;
    }
}
