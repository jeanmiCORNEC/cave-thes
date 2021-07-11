<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('isPro', ChoiceType::class, [
                 'choices' => [
                     'un particulier' => 'particulier',
                     'un professionnel' => 'professionnel'
                 ],
                 'required' => true,
                 'expanded' => true,
                 'multiple' => false,
                 'label' => 'vous êtes ? ',
                 'attr' => [
                     'class' => 'form-group', 
                 ]
             ])
            ->add('name', TextType::class, [
                'label' => 'votre nom',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'votre prénom',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('society', TextType::class, [
                'label' => 'société',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'email ',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'téléphone',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
             ->add('object', ChoiceType::class, [
                 'choices' => [
                     'commande' => 'commande',
                     'informations' => 'informations',
                     'catalogue' => 'catalogue',
                     'autre ...' => 'autre'
                 ],
                 'label' => 'sujet',
                 'attr' => [
                     'class' => 'form-select'
                 ]
             ])
            ->add('comment', CKEditorType::class, [
                'label' => 'commentaires',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
