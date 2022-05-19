<?php

namespace App\Form;

use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrez le nom de la session...',
                    'class' => 'form-control'
                ]
            ])
            ->add('start', DateType::class, [
                "label" => "Date de début",
                "input" => "datetime_immutable",
                "widget" => "single_text",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('end', DateType::class, [
                "label" => "Date de fin",
                "input" => "datetime_immutable",
                "widget" => "single_text",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('size', IntegerType::class, [
                'label' => 'Taille de la session',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 10,
                    'max' => 25
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
