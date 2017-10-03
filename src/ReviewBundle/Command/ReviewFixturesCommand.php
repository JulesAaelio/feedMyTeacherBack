<?php

namespace ReviewBundle\Command;

use ReviewBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ReviewFixturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('review:fixtures')
            ->setDescription("Chargement du jeu d'essai");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $argument = $input->getArgument('argument');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $em->persist(new Review(5, 'tip_top', 0, 'pas tip top'));
        $em->persist(new Review(5, 'tik tok', 5, 'Make the party non stop'));
        $em->persist(new Review(5, 'MA-CHA-LAH LE PROF', 1, 'Pas écouté. Je regardais le prof'));
        $em->flush();
        $output->writeln('<info>OK.</info>');
    }

}
