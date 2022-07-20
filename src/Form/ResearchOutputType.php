<?php

namespace App\Form;

use App\Entity\ResearchOutput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResearchOutputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('type')
            ->add('identifier')
            ->add('description')
            ->add('standardUsed')
            ->add('reused')
            ->add('lineage')
            ->add('issued')
            ->add('language')
            ->add('keyword')
            ->add('contact')
            ->add('romp')
            ->add('vocabularyInfos')
            ->add('researchOutputs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResearchOutput::class,
        ]);
    }
}
