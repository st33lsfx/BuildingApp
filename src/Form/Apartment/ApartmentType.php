<?php

namespace App\Form\Apartment;

use App\Entity\Building\Building;
use App\Entity\Person\Person;
use App\Model\Apartment\ApartmentModel;
use App\Repository\Building\BuildingRepository;
use App\Repository\Person\PersonRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApartmentType extends AbstractType
{
    private BuildingRepository $buildingRepository;
    private PersonRepository $personRepository;
    public function __construct(BuildingRepository $buildingRepository, PersonRepository $personRepository)
    {
        $this->buildingRepository = $buildingRepository;
        $this->personRepository = $personRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Název'
                ]
            )
            ->add(
                'size',
                NumberType::class,
                [
                    'label' => 'velikost',
                    'required' => false
                ]
            )
            ->add(
                'coldWaterStatus',
                NumberType::class,
                [
                    'label' => 'Stav studené vody',
                    'required' => false
                ]
            )
            ->add(
                'hotWaterStatus',
                NumberType::class,
                [
                    'label' => 'Stav teplé vody',
                    'required' => false
                ]
            )
            ->add(
                'gasMeterStatus',
                NumberType::class,
                [
                    'label' => 'Stav plynoměru',
                    'required' => false
                ]
            )
            ->add(
                'squareStatus',
                NumberType::class,
                [
                    'label' => 'Stav elektroměru',
                    'required' => false
                ]
            )
            ->add(
                'building',
                EntityType::class,
                [
                    'label' => 'Výběr budovy',
                    'attr' => ['class' => 'form-control'],
                    'class' => Building::class,
                    'choice_label' => function ($building) {
                        return $building->getTitle();
                    },
                    'choices' => $this->buildingRepository->findAll(),
                ]
            )
            ->add(
                'person',
                EntityType::class,
                [
                    'label' => 'Vlastník',
                    'attr' => ['class' => 'form-control'],
                    'class' => Person::class,
                    'choice_label' => function ($person) {
                        return $person->getFirstName();
                    },
                    'choices' => $this->personRepository->findAll(),
                    'required' => false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ApartmentModel::class,
        ]);
    }
}
