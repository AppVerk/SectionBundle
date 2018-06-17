<?php

namespace AppVerk\SectionBundle\Util;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ConfigProvider
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @required
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function getSettings($parameter): array
    {
        return $this->container->getParameter("appverk_sections.$parameter");
    }

    public function getFieldDefinition($type): array
    {
        return $this->container->getParameter("appverk_sections.fields.$type");
    }

    public function getSectionSettings()
    {
        return $this->getSettings('sections');
    }

    public function isTranslatableEnabled(): bool
    {
        return $this->container->getParameter("appverk_sections.options.translatable");
    }

    public function getLanguages()
    {
        return $this->container->getParameter("appverk_sections.options.languages");
    }

    public function getFieldExtender($name)
    {
        $settings = $this->getSettings('fields.'.$name);
        return $settings['extender'];
    }

    public function getSectionFields($sectionName)
    {
        $sections = $this->getSectionSettings();
        foreach ($sections as $key => $data) {
            if ($key === $sectionName) {
                return $data['fields'];
            }
        }

        return [];
    }

    public function getTemplates()
    {
        $templateChoices = [];
        $templates = $this->getSettings('sections');

        foreach ($templates as $key => $template) {
            $templateChoices[$template['name']] = $template['name'];
        }

        return $templateChoices;
    }

    public function getSectionSetting($type, $setting)
    {
        $sections = $this->getSectionSettings();
        foreach ($sections as $key => $data) {
            if ($key === $type and array_key_exists($setting, $data)) {
                return $data[$setting];
            }
        }

        return '';
    }
}
