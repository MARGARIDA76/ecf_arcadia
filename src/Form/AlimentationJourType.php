<?php

namespace App\Form;

use App\Entity\AlimentationJour;
use App\Entity\Animal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimentationJourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nourriture')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('quantite')
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AlimentationJour::class,
        ]);
    }
}
