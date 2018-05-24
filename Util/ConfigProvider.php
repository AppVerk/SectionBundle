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

    public function getTemplates(): array
    {
        $templateChoices = [];
        $templates = $this->getSettings('section');

        foreach ($templates as $key => $template) {
            $templateChoices[$template['name']] = $template['name'];
        }

        return $templateChoices;
    }

    public function getTemplateSettings($templateName): array
    {
        $templates = $this->getSettings("section");
        foreach ($templates as $k => $template) {
            if ($template['name'] === $templateName) {
                return $template;
            }
        }

        return [];
    }

    public function getSectionModel($templateName): string
    {
        $templates = $this->getSettings("section");
        foreach ($templates as $k => $template) {
            if ($template['name'] === $templateName) {
                return $template['model'];
            }
        }

        return "";
    }

    public function getFieldAdminTemplate($fieldName)
    {
        $fieldSettings = $this->getSettings('fields.'.$fieldName);

        return $fieldSettings['admin_template'];
    }

    public function getSectionAdminTemplate($templateName)
    {
        $templates = $this->getTemplateSettings($templateName);

        return $templates['admin_template'];
    }

    public function getSectionBlock($templateName)
    {
        $templates = $this->getTemplateSettings($templateName);

        return $templates['block'];
    }

    public function getSectionThemes(): array
    {
        $sectionThemesArray = [];
        $sectionThemes = $this->getSettings('section_themes');
        foreach ($sectionThemes as $sectionTheme) {
            $sectionThemesArray[$sectionTheme['label']] = $sectionTheme['value'];
        }

        return $sectionThemesArray;
    }

    public function getSectionView(string $action) : string
    {
        $parameter = 'section.actions.'.$action;

        return $this->container->getParameter("appverk_sections.$parameter");
    }

    public function getFieldView(string $action, string $fieldType) : string
    {
        $parameter = 'fields.'.$fieldType.'.actions.'.$action;

        return $this->container->getParameter("appverk_sections.$parameter");
    }
}
