<?php

namespace AppVerk\SectionBundle\Command;

use AppVerk\SectionBundle\Service\SectionBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SectionBuildCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('section:create:sections')
            ->setDescription('Creates sections defined in configuration file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var SectionBuilder $sectionBuilder */
        $sectionBuilder = $this->getContainer()->get(SectionBuilder::class);
        $status = $sectionBuilder->buildSections();

        $io = new SymfonyStyle($input, $output);
        if ($status === true) {
            $io->success("Sections successfully created!");
        } else {
            $io->error("Error while creating sections, for more information check log file!");
        }
    }
}
