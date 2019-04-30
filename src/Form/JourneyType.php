<?php

namespace App\Form;

use App\Entity\Journey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date', DateTimeType::class,[
                'widget' => 'single_text',
                'label' => 'date du depart',
            ])
            ->add('Name', TextType::class, [
                'label' => 'Voyageur'
            ])
            ->add('JourneyHasSites', CollectionType::class, [
                'entry_type' => JourneyHasSiteType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('Save', SubmitType::class, [
                'attr' => [
                    'class' => 'd-none js-submit-button btn btn-primary',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Journey::class,
        ]);
    }
}
