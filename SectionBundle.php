<?php

namespace AppVerk\SectionBundle;

use AppVerk\SectionBundle\DependencyInjection\Compiler\TranslatablePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SectionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TranslatablePass());
    }
}
