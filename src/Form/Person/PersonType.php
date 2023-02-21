<?php

namespace App\Form\Person;

use App\Entity\Apartments\Apartment;
use App\Model\Person\PersonModel;
use App\Repository\Apartment\ApartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    private ApartmentRepository $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'firstName',
                TextType::class,
                [
                    'label' => 'Jméno'
                ]
            )
            ->add(
                'lastName',
                TextType::class,
                [
                    'label' => 'Příjmení'
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Email',
                    'required' => false
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'Telefon'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonModel::class,
        ]);
    }
}
