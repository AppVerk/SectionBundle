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
//var_dump($config);die();
//        foreach ($config['fields'] as $field => $parameters) {
//            $container->setParameter("appverk_sections.fields.$field", $parameters);
//        }
//
//        foreach ($config['section_templates'] as $sectionTemplate) {
//            foreach ($sectionTemplate['fields'] as $field) {
//                $factory = null;
//                if ($field['options'] === [] || $field['settings'] === false) {
//                    continue;
//                }
//
//                $fieldConfiguration = null;
//
//                foreach ($config['fields'] as $key => $parameters) {
//                    $fieldConfiguration = $container->getParameter("appverk_sections.fields.".$field['type']);
//                }
//
//                if (!$fieldConfiguration || !$fieldConfiguration['factory']) {
//                    throw new \Exception(
//                        "Field configuration for \"".$field['type']."\" dasn't exists or factory option dasn't set"
//                    );
//                }
//                $fieldFactoryClass = $fieldConfiguration['factory'];
//                if ($fieldFactoryClass && is_string($fieldFactoryClass)) {
//                    $factory = new $fieldFactoryClass();
//                    foreach ($field as $fieldSetting => $value) {
//                        if (!array_key_exists($fieldSetting, $factory->getOptions()) && $fieldSetting !== 'type') {
//                            throw new \Exception(
//                                "Invalid field option \"$fieldSetting\" for field of type: ".$field['type']
//                            );
//                        }
//                    }
//                }
//            }
//        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('doctrine.yml');
    }
}
