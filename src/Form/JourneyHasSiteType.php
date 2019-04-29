<?php

namespace App\Form;

use App\Entity\JourneyHasSite;
use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneyHasSiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('Start')
//            ->add('End')
//            ->add('Journey')
            ->add('Site', EntityType::class,[
                'class' => Site::class,
                'label' => false,
                'attr' => [
                    'class' => 'js-site-id-placeholder d-none',
                ],
            ])
            ->add('Site_Name', TextType::class, [
                'attr' => [
                    'class' => 'js-site-name-placeholder mt-1 w-100',
                ],
                'mapped' => false,
                'disabled' => true,
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JourneyHasSite::class,
        ]);
    }
}
