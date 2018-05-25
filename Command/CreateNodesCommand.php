<?php

namespace AppVerk\SectionBundle\Command;

use AppVerk\SectionBundle\Service\NodesBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateNodesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('section:create:nodes')
            ->setDescription('Creates nodes and sections defined in configuration file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var NodesBuilder $nodeBuilder */
        $nodeBuilder = $this->getContainer()->get(NodesBuilder::class);
        $status = $nodeBuilder->buildNodes();

        $io = new SymfonyStyle($input, $output);
        if ($status === true) {
            $io->success("Nodes and sections successfully created!");
        } else {
            $io->error("Error while creating nodes and sections, for more information check log file!");
        }
    }
}
