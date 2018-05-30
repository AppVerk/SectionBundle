<?php

namespace AppVerk\SectionBundle\DependencyInjection\Compiler;

use AppVerk\SectionBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TranslatablePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig('section');
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if ($config['options']['translatable'] === true) {
            $knpConfigs = $container->getExtensionConfig('knp_doctrine_behaviors');
            $knpConfiguration = new \Knp\DoctrineBehaviors\Bundle\DependencyInjection\Configuration();
            $knpConfig = $this->processConfiguration($knpConfiguration, $knpConfigs);
            if ($knpConfig['translatable'] !== true) {
                throw new \Exception(
                    'Translatable extension is not enabled! Enable it in Your config file, set knp_doctrine_behaviors: translatable: true'
                );
            }
        }
    }

    private function processConfiguration(ConfigurationInterface $configuration, array $configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration($configuration, $configs);
    }
}
