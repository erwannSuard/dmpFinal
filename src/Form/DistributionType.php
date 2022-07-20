<?php

namespace App\Form;

use App\Entity\Distribution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistributionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sizeUnit')
            ->add('accessUrl')
            ->add('accessProtocol')
            ->add('sizeValue')
            ->add('access')
            ->add('format')
            ->add('downloadUrl')
            ->add('embargo')
            ->add('licence')
            ->add('host')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Distribution::class,
        ]);
    }
}
