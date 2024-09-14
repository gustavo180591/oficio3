<?php

namespace App\Form;

use App\Entity\Delegacion;
use App\Entity\Oficio;
use App\Entity\Registro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('description')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('phone')
            ->add('dni')
            ->add('address')
            ->add('workAddress')
            ->add('payment')
            ->add('time')
            ->add('certification')
            ->add('institution')
            ->add('recomendation')
            ->add('images')
            ->add('oficio', EntityType::class, [
                'class' => oficio::class,
                'choice_label' => 'name',
            ])
            ->add('delegacion', EntityType::class, [
                'class' => delegacion::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registro::class,
        ]);
    }
}
