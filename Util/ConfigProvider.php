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

    public function getSectionView(string $action): string
    {
        $parameter = 'section.actions.'.$action;

        return $this->container->getParameter("appverk_sections.$parameter");
    }

    public function getFieldView(string $action, string $fieldType): string
    {
        $parameter = 'fields.'.$fieldType.'.actions.'.$action;

        return $this->container->getParameter("appverk_sections.$parameter");
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
}
