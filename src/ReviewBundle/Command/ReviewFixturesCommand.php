<?php

namespace ReviewBundle\Command;

use ReviewBundle\Entity\Division;
use ReviewBundle\Entity\Module;
use ReviewBundle\Entity\Review;
use ReviewBundle\Entity\Student;
use ReviewBundle\Entity\Subject;
use ReviewBundle\Entity\Teacher;
use ReviewBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use UserBundle\Form\StudentType;

class ReviewFixturesCommand extends ContainerAwareCommand
{
    private $progressBar;
    protected function configure()
    {
        $this
            ->setName('review:fixtures')
            ->setDescription("Chargement du jeu d'essai");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Chargement du jeu d\'essai.</info>');

        $converter = $this->getContainer()->get('import.csv2array');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $rows = $converter->convert(__DIR__ . '/../Resources/Imports/subjects.csv');
        if ($rows != false) {
            $progress = new ProgressBar($output,count($rows));
            $output->writeln('<info>Chargement des matières</info>');
            foreach ($rows as $row) {
                $subject = new Subject($row['title']);
                $em->persist($subject);
            }
            $this->finishStep($progress,$output);
        }

        $rows = $converter->convert(__DIR__ . '/../Resources/Imports/division.csv');
        if ($rows != false) {
            $progress = new ProgressBar($output,count($rows));
            $output->writeln('<info>Chargement des classes</info>');
            foreach ($rows as $row) {
                $division = new Division($row['school'], $row['grade']);
                $em->persist($division);
            }
            $this->finishStep($progress,$output);
        }

        $rows = $converter->convert(__DIR__ . '/../Resources/Imports/teachers.csv');
        if ($rows != false) {
            $progress = new ProgressBar($output,count($rows));
            $output->writeln('<info>Chargement des professeurs</info>');
            foreach ($rows as $row) {
                $teacher = new Teacher($row['firstName'], $row['lastName'], $row['email']);
                $this->setDefaultPassword($teacher);
                $em->persist($teacher);
            }
            $this->finishStep($progress,$output);
        }

        $rows = $converter->convert(__DIR__ . '/../Resources/Imports/modulese.csv');
        if ($rows != false) {
            $progress = new ProgressBar($output,count($rows));
            $output->writeln('<info>Chargement des cours</info>');
            foreach ($rows as $row) {
                $subject = $em->getReference('ReviewBundle:Subject', $row['subject']);
                $teacher = $em->getReference('ReviewBundle:Teacher', $row['teacher']);
                $division = $em->getReference('ReviewBundle:Division', $row['division']);

                $module = Module::createFull($subject, $teacher, $division);

                $em->persist($module);
                $progress->advance();
            }
            $this->finishStep($progress,$output);
        }

        $rows = $converter->convert(__DIR__ . '/../Resources/Imports/studentes.csv',';');
        if ($rows != false) {
            $progress = new ProgressBar($output,count($rows));
            $output->writeln('<info>Chargement des étudiants </info>');
            foreach ($rows as $row) {
                $division = $em->getReference('ReviewBundle:Division', $row['group']);
                $student = new Student($row['firstName'], $row['lastName'], $row['email'], $division);
                $this->setDefaultPassword($student);
                if($student->getEmail() == 'jules.laurent@ynov.com' || $student->getEmail() ==  'alexandra.ramadour@ynov.com')
                {
                    $student->addRole('ROLE_ADMIN');
                }
                $em->persist($student);
                $progress->advance();
            }
            $this->finishStep($progress,$output);
        }

    }

    private function setDefaultPassword(User $user)
    {
        $encoder = $this->getContainer()->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'p@ssw0rd');
        $user->setPassword($password);
    }

    private function finishStep(ProgressBar $progressBar,OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->flush();
        if(is_object($progressBar))
        {
            $progressBar->finish();
            $output->writeln('');
        }
    }
}
