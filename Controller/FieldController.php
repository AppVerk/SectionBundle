<?php

namespace AppVerk\SectionBundle\Controller;

use AppVerk\Components\Controller\LanguageAccessControllerInterface;
use AppVerk\SectionBundle\Doctrine\FieldManager;
use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Form\Handler\FieldFormHandler;
use AppVerk\SectionBundle\Form\Type\FieldType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/field")
 */
class FieldController extends BaseController implements LanguageAccessControllerInterface
{
    /**
     * @Route("/edit/{field}/{lang}", name="section_field_edit")
     * @Method({"GET", "POST"})
     */
    public function editFieldAjaxAction(
        Field $field,
        $lang,
        FieldFormHandler $fieldFormHandler,
        Request $request
    ) {
        $returnParameters = ['lang' => $lang];
        $returnParameters['object'] = $field;
        $field->setCurrentLocale($lang);

        if ($request->getMethod() === 'GET') {
            $form = $fieldFormHandler->buildForm(FieldType::class, $field)->getFormView();
            $returnParameters['form'] = $form;
        } else {
            if ($request->getMethod() === 'POST') {
                $form = $fieldFormHandler->buildForm(FieldType::class, $field);

                if (!$fieldFormHandler->process()) {
                    $this->addFlashMessage('danger', $fieldFormHandler->getErrorsAsString());
                } else {
                    $this->addFlashMessage('success', 'field.edit.successful');
                }
                $returnParameters['form'] = $form->getFormView();
            }
        }

        return $this->render($this->configProvider->getFieldView('edit', $field->getType()), $returnParameters);
    }

    /**
     * @Route("/delete/{field}/{lang}", name="section_field_delete")
     * @Method("GET")
     */
    public function deleteAction(
        Field $field,
        $lang = null,
        FieldManager $fieldManager
    ) {
        if (!$lang) {
            $fieldManager->remove($field);
        }

        if ($lang) {
            $fieldManager->removeTranslation($field, $lang);
        }

        return $this->render($this->configProvider->getFieldView('remove', $field->getType()), ['lang' => $lang]);
    }
}
