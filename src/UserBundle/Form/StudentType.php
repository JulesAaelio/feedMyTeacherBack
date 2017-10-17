<?php
namespace UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class, array('label' => 'Prénom :'))
            ->add('lastName', TextType::class, array('label' =>'NOM :'))
            ->add('password',PasswordType::class, array('label' => 'Mot de passe :'))
            ->add('email',EmailType::class, array('label' =>'E-mail :'))
            ->add('division',EntityType::class,array('class' => 'ReviewBundle:Division','choice_label'=>'fullName','label'=>'Classe : '))
            ->add('save', SubmitType::class, array('label' => "S'inscire"));
        ;
    }
}