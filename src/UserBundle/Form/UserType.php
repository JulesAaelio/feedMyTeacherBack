<?php
namespace ReviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class, array('label' => 'Note :'))
            ->add('lastName', TextType::class, array('label' =>'Commentaire :'))
            ->add('password',PasswordType::class, array('label' => 'Note :'))
            ->add('email',EmailType::class, array('label' =>'Commentaire :'))
            ->add('save', SubmitType::class, array('label' => 'Publier'))
        ;
    }
}