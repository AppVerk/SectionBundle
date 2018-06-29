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
            new \Twig_SimpleFunction('section_template', [$this, 'getSectionTemplate']),
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

    private function getSectionBlocks($name)
    {
        return $this->configProvider->getSectionSetting($name, 'blocks');
    }

    public function getSectionTemplate($name, $type)
    {
        $views = $this->getSectionBlocks($name);

        return $views[$type];
    }
}
