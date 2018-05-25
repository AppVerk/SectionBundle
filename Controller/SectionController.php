<?php

namespace AppVerk\SectionBundle\Controller;

use AppVerk\Components\Controller\LanguageAccessControllerInterface;
use AppVerk\SectionBundle\Doctrine\SectionManager;
use AppVerk\SectionBundle\Entity\Section;
use AppVerk\SectionBundle\Entity\SectionDefault;
use AppVerk\SectionBundle\Form\Handler\SectionFormHandler;
use AppVerk\SectionBundle\Form\Type\SectionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/section")
 */
class SectionController extends BaseController implements LanguageAccessControllerInterface
{
    /**
     * @Route("/create/{lang}", name="section_create")
     * @Method({"GET", "POST"})
     */
    public function createSectionAction(
        $lang,
        SectionFormHandler $sectionFormHandler,
        Request $request
    ) {
        $returnParameters = ['lang' => $lang];

        if ($request->getMethod() === 'GET') {
            $form = $sectionFormHandler->buildForm(SectionType::class, new SectionDefault())->getFormView();
            $returnParameters['form'] = $form;
        } else {
            if ($request->getMethod() === 'POST') {
                $sectionTemplate = $request->request->get('section')['template'];
                $dataClass = $this->configProvider->getTemplateSettings($sectionTemplate)['model'];

                $section = new $dataClass();
                $section->setCurrentLocale($lang);

                $sectionFormHandler->buildForm(SectionType::class, $section);

                if (!$sectionFormHandler->process()) {
                    $this->addFlashMessage('danger', $sectionFormHandler->getErrorsAsString());
                } else {
                    $this->addFlashMessage('success', 'section.create.successful');
                }
                $returnParameters['object'] = $section;
            }
        }

        return $this->render($this->configProvider->getSectionView('create'), $returnParameters);
    }

    /**
     * @Route("/edit/{section}/{lang}", name="section_edit")
     * @Method({"GET", "POST"})
     */
    public function editSectionAction(
        Section $section,
        $lang,
        SectionFormHandler $sectionFormHandler,
        Request $request
    ) {
        $returnParameters = ['lang' => $lang];
        if ($request->getMethod() === 'GET') {
            $form = $sectionFormHandler->buildForm(SectionType::class, $section)->getFormView();
            $returnParameters['form'] = $form;
        } else {
            if ($request->getMethod() === 'POST') {
                $section->setCurrentLocale($lang);

                $sectionFormHandler->buildForm(SectionType::class, $section);

                if (!$sectionFormHandler->process()) {
                    $this->addFlashMessage('danger', $sectionFormHandler->getErrorsAsString());
                } else {
                    $this->addFlashMessage('success', 'section.edit.successful');
                }
                $returnParameters['object'] = $section;
            }
        }

        return $this->render($this->configProvider->getSectionView('edit'), $returnParameters);
    }

    /**
     * @Route("/delete/{section}/{lang}", name="section_delete")
     * @Method("GET")
     */
    public function deleteAction(
        Section $section,
        $lang = null,
        SectionManager $sectionManager
    ) {
        if (!$lang && $this->getUser()->isSuperAdmin()) {
            $sectionManager->remove($section);
        }

        if ($lang) {
            $sectionManager->removeTranslation($section, $lang);
        }

        return $this->render($this->configProvider->getSectionView('remove'), ['lang' => $lang]);
    }
}
