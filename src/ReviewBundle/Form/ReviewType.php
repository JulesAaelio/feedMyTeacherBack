<?php

namespace ReviewBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teacherRate',null,['label'=>'Note[Professeur]'])
            ->add('teacherReview',null,['label'=>'Commentaire[Professeur]'])
            ->add('classRate',null,['label'=>'Note[Classe]'])
            ->add('classReview',null,['label'=>'Commentaire[Classe]'])
            ->add('module',null,['label'=>'Cours'])
            ->add('sender',null,['label'=>'Auteur'])
            ->add('save', SubmitType::class, array('label' => "VALIDER"));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReviewBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reviewbundle_review';
    }


}
