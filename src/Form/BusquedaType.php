<?php

namespace App\Form;

use App\Entity\Delegacion;
use App\Entity\Oficio;
use App\Entity\Registro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusquedaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder                      
            ->add('oficio', EntityType::class, [
                'class' => oficio::class,
                'choice_label' => 'name',
                
            ])
            ->add('delegacion', EntityType::class, [
                'class' => delegacion::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,  // Si deseas que sea un menú desplegable en lugar de checkboxes
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
