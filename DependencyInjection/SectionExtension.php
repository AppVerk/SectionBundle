<?php

namespace AppVerk\SectionBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SectionExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('appverk_sections.options.translatable', $config['options']['translatable']);

        if ($config['options']['translatable'] === true) {
            $this->checkTranslatableExtensions($container);
        }

        $container->setParameter('appverk_sections.sections', $config['sections']);
        $container->setParameter('appverk_sections.options.languages', $config['options']['languages']);

        foreach ($config['fields'] as $field => $parameters) {
            $container->setParameter("appverk_sections.fields.$field", $parameters);
            foreach ($parameters['views'] as $key => $view) {
                $container->setParameter("appverk_sections.fields.$field.views.$key", $view);
            }
        }

        foreach ($config['sections'] as $sectionKey => $sectionConfig) {
            foreach ($sectionConfig['views'] as $key => $view) {
                $container->setParameter("appverk_sections.sections.".$sectionKey.'.views.'.$key, $view);
            }
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('doctrine.yml');
    }

    private function checkTranslatableExtensions(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (!array_key_exists('DoctrineBehaviorsBundle', $bundles)) {
            throw new \Exception(
                "KNPDoctrineBehaviorsBundle does not exist! Please install it if You want to use translatable."
            );
        }
    }
}
