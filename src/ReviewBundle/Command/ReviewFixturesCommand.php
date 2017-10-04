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
            new Teacher('COMUNI','KANT'),
            new Teacher('SAM','LECASSE'),
            new Teacher('XAVIER','KAFERGAFFE'),
            new Teacher('JAY','DESSSERTIFS'),
            new Teacher('MATHIAS','DECAFER')

        ];
        foreach ($teachers as $teacher)
        {
            $em->persist($teacher);
        }

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
            new Student('HACEN','SEHEF',$divisions[0]),
            new Student('LENI','BARS',$divisions[0]),
            new Student('HOMER','DALORE',$divisions[0]),
            new Student('PAUL','UTION',$divisions[1]),
            new Student('HARRY','COT',$divisions[1]),
            new Student('SARAH','FRECHIE',$divisions[1]),
        ];
        foreach ($students as $student)
        {
            $em->persist($student);
        }

        $em->persist(new Review(5, 'tip_top', 0, 'pas tip top',$modules[0],$students[0]));
        $em->persist(new Review(5, 'tik tok', 5, 'Make the party non stop',$modules[1],$students[1]));
        $em->persist(new Review(5, 'MA-CHA-LAH LE PROF', 1, 'Pas écouté. Je regardais le prof',$modules[2],$students[2]));
        $em->flush();
        $output->writeln('<info>OK.</info>');
    }

}
