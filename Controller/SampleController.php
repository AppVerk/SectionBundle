<?php

namespace AppVerk\SectionBundle\Controller;

use AppVerk\SectionBundle\Entity\Section;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/sample")
 */
class SampleController extends BaseController
{
    /**
     * @Route("/section/{section}/{lang}", name="section_show")
     * @Method("GET")
     */
    public function sectionAction(Section $section, $lang)
    {
        return $this->render(
            $this->configProvider->getSectionView('front', $section->getName()),
            ['lang' => $lang, 'section' => $section]
        );
    }
}
