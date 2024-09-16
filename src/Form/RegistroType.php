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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('certification', ChoiceType::class, [
                'choices'  => [
                    'Sí' => true,
                    'No' => false,
                ],
                'expanded' => true, // Esto hace que se renderice como checkboxes
                'multiple' => false, // Solo se puede seleccionar una opción
                'label' => 'Certificación',
            ])
            ->add('institution')
            ->add('recomendation')
            ->add('images')
            ->add('oficio', EntityType::class, [
                'class' => oficio::class,
                'choice_label' => 'name',
            ])
            ->add('delegacion', EntityType::class, [
                'class' => Delegacion::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => function() {
                    return ['class' => 'form-check-input me-3 mb-3']; // Espaciado entre opciones
                },
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
