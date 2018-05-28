<?php

namespace AppVerk\SectionBundle\Twig;

use AppVerk\SectionBundle\Util\ConfigProvider;

class TemplateExtension extends \Twig_Extension
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function __construct(ConfigProvider $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('template', [$this, 'getTemplate']),
            new \Twig_SimpleFunction('field_template', [$this, 'getFieldAdminTemplate']),
            new \Twig_SimpleFunction('section_template', [$this, 'getSectionAdminTemplate']),
            new \Twig_SimpleFunction('section_block', [$this, 'getSectionBlock']),
        ];
    }

    public function getTemplate($name)
    {
        return $this->configProvider->getTemplateSettings($name);
    }

    public function getFieldAdminTemplate($name)
    {
        return $this->configProvider->getFieldAdminTemplate($name);
    }

    public function getSectionAdminTemplate($name)
    {
        return $this->configProvider->getSectionAdminTemplate($name);
    }

    public function getSectionBlock($name)
    {
        return $this->configProvider->getSectionBlock($name);
    }
}
