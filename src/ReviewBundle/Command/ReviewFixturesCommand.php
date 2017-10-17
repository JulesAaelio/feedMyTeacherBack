<?php

namespace ReviewBundle\Command;

use ReviewBundle\Entity\Division;
use ReviewBundle\Entity\Module;
use ReviewBundle\Entity\Review;
use ReviewBundle\Entity\Student;
use ReviewBundle\Entity\Subject;
use ReviewBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use UserBundle\Form\StudentType;

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
        //$argument = $input->getArgument('argument');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $subjects = [
            new Subject('COM'),
            new Subject('MICROSOFT SERVER'),
            new Subject('HTML'),
            new Subject('SYMFONY'),
            new Subject('AD'),
        ];
        foreach ($subjects as $subject)
        {
            $em->persist($subject);
        }


        $divisions = [
            new Division('INGESUP','B1'),
            new Division('INGESUP','B2')
        ];
        foreach ($divisions as $division)
        {
            $em->persist($division);
        }

        $teachers = [
            new Teacher('COMUNI','KANT',' communi.kant@ynov.com'),
            new Teacher('SAM','LECASSE','sam.lecasse@ynov.com'),
            new Teacher('XAVIER','KAFERGAFFE','xavier.kafergaffe@ynov.com'),
            new Teacher('JAY','DESSSERTIFS','jay.dessertifs@ynov.com'),
            new Teacher('MATHIAS','DECAFER','mathias.decafer@ynov.com')

        ];

        $modules = [
            new Module($subjects[0],$teachers[0],$divisions[0]),
            new Module($subjects[1],$teachers[1],$divisions[0]),
            new Module($subjects[2],$teachers[2],$divisions[0]),
            new Module($subjects[3],$teachers[4],$divisions[1]),
            new Module($subjects[4],$teachers[3],$divisions[1])
        ];
        foreach ($modules as $module)
        {
            $em->persist($module);
        }

        $students = [
            new Student('HACEN','SEHEF','hacen.sehef@ynov.com',$divisions[0]),
            new Student('LENI','BARS','leni.bars@ynov.com',$divisions[0]),
            new Student('HOMER','DALORE','homer.dalore@ynov.com',$divisions[0]),
            new Student('PAUL','UTION','paul.ution@ynov.com',$divisions[1]),
            new Student('HARRY','COT','harry.cot@ynov.com',$divisions[1]),
            new Student('SARAH','FRECHIE','sarah.frechie@ynov.com',$divisions[1]),
        ];

        $admins = [
            new Student('Jules','LAURENT','jules.laurent@ynov.com',$divisions[1]),
            new Student('Alexandra','RAMADOUR','alexandra.ramadour@ynov.com',$divisions[1]),
        ];

        foreach ($admins as $admin)
        {
            $admin->addRole('ROLE_ADMIN');
        }

        $usersGroups = [$admins,$students,$teachers];
        foreach ($usersGroups as $usersGroup)
        {
            foreach ($usersGroup as $user) {
                $encoder = $this->getContainer()->get('security.password_encoder');
                $password = $encoder->encodePassword($user, 'p@ssw0rd');
                $user->setPassword($password);
                $em->persist($user);
            }
        }

        $em->persist( Review::createFull(5, 'tip_top', 0, 'pas tip top',$modules[0],$students[0]));
        $em->persist( Review::createFull(5, 'tik tok', 5, 'Make the party non stop',$modules[1],$students[1]));
        $em->persist( Review::createFull(5, 'MA-CHA-LAH LE PROF', 1, 'Pas écouté. Je regardais le prof',$modules[2],$students[2]));
        $em->flush();
        $output->writeln('<info>OK.</info>');
    }

}
