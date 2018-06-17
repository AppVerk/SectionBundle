<?php

namespace AppVerk\SectionBundle\Form\Handler;

use AppVerk\Components\Form\Handler\AbstractFormHandler;
use AppVerk\SectionBundle\Doctrine\SectionManager;

class SectionDefaultEditFormHandler extends AbstractFormHandler
{
    /** @var SectionManager */
    private $sectionManager;

    public function __construct(
        SectionManager $sectionManager
    ) {
        $this->sectionManager = $sectionManager;
    }

    protected function success()
    {
        $section = $this->form->getData();

        $this->sectionManager->persistAndFlash($section);
        return $section;
    }

}
