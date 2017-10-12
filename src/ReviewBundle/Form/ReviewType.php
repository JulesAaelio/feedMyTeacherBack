<?php
namespace ReviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teacherRate',IntegerType::class, array('label' => 'Note :'))
            ->add('teacherReview', TextareaType::class, array('label' =>'Commentaire :'))
            ->add('classRate',IntegerType::class, array('label' => 'Note :'))
            ->add('classReview',TextareaType::class, array('label' =>'Commentaire :'))
            ->add('save', SubmitType::class, array('label' => 'Publier'))
        ;
    }
}