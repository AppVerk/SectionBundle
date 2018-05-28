<?php

namespace AppVerk\SectionBundle\Controller;

use AppVerk\SectionBundle\Util\ConfigProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Translation\TranslatorInterface;

class BaseController extends AbstractController
{
    /**
     * @var ConfigProvider
     */
    protected $configProvider;

    public function __construct(ConfigProvider $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     *
     * @required
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    protected function addFlashMessage(string $type, string $message, $domain = 'messages')
    {
        $this->addFlash($type, $this->translator->trans($message, [], $domain));
    }
}
