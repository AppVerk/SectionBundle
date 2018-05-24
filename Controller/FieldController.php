<?php

namespace AppVerk\SectionBundle\Controller;

use AppVerk\Components\Controller\LanguageAccessControllerInterface;
use AppVerk\Components\Doctrine\TranslationEntityInterface;
use AppVerk\SectionBundle\Doctrine\FieldManager;
use AppVerk\SectionBundle\Entity\Field;
use AppVerk\SectionBundle\Entity\FieldCheckbox;
use AppVerk\SectionBundle\Entity\FieldChoice;
use AppVerk\SectionBundle\Form\Handler\FieldFormHandler;
use AppVerk\SectionBundle\Form\Type\FieldType;
use AppVerk\SectionBundle\Util\ConfigProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/field")
 */
class FieldController extends BaseController implements LanguageAccessControllerInterface
{
    /**
     * @Route("/edit/{field}/{lang}", name="section_field_edit")
     * @Method({"GET", "POST"})
     */
    public function editFieldAjaxAction(Field $field, $lang, FieldFormHandler $fieldFormHandler, Request $request, ConfigProvider $configProvider)
    {
        $returnParameters = ['lang' => $lang];

        if ($request->getMethod() === 'GET') {
            $form = $fieldFormHandler->buildForm(FieldType::class, $field)->getFormView();
            $returnParameters['form'] = $form;
        } else if ($request->getMethod() === ' POST') {
            if ($field instanceof TranslationEntityInterface) {
                $field->setCurrentLocale($lang);
            }

            $fieldFormHandler->buildForm(FieldType::class, $field);

            if (!$fieldFormHandler->process()) {
                $this->addFlashMessage('danger', $fieldFormHandler->getErrorsAsString());
            } else {
                $this->addFlashMessage('success', 'field.edit.successful');
            }
            $returnParameters['object'] = $field;
        }

        return $this->render($configProvider->getFieldView('edit', $field->getType()), $returnParameters);
    }

    /**
     * @Route("/update/{field}/{lang}", name="section_field_post_update")
     * @Method("POST")
     */
    public function postUpdateSettingField(Field $field, $lang, FieldManager $fieldManager, Request $request)
    {
        if ($field instanceof TranslationEntityInterface) {
            $field->setCurrentLocale($lang);
        }

        if ($field instanceof FieldCheckbox) {
            $field->setChecked(($request->get('value') === 'true') ? true : false);
        }
        if ($field instanceof FieldChoice) {
            $field->setValue($request->get('value'));
        }

        $fieldManager->persist($field);
        $fieldManager->flush();

        return new JsonResponse();

    }

    /**
     * @Route("/delete/{field}/{lang}", name="grid_field_delete")
     * @Method("GET")
     */
    public function deleteAction(
        Field $field,
        $lang = null,
        FieldManager $fieldManager,
        ConfigProvider $configProvider
    ) {
        if (!$lang && $this->getUser()->isSuperAdmin()) {
            $fieldManager->remove($field);
        }

        if ($lang) {
            $fieldManager->removeTranslation($field, $lang);
        }

        return $this->render($configProvider->getSectionView('remove'), ['lang' => $lang]);
    }
}
