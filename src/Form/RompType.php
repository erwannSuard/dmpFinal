<?php

namespace App\Form;

use App\Entity\Romp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifier')
            ->add('submissionDate')
            ->add('version')
            ->add('deliverable')
            ->add('licence')
            ->add('ethicalIssues')
            ->add('contact')
            ->add('project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Romp::class,
        ]);
    }
}
