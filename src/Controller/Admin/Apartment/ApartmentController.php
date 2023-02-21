<?php

namespace App\Controller\Admin\Apartment;

use App\Entity\Apartments\Apartment;
use App\Factory\Apartment\ApartmentFactory;
use App\Form\Apartment\ApartmentType;
use App\Model\Apartment\ApartmentModel;
use App\Repository\Apartment\ApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentController extends AbstractController
{

    private ApartmentRepository $apartmentRepository;
    private ApartmentFactory $apartmentFactory;
    public function __construct(ApartmentRepository $apartmentRepository, ApartmentFactory $apartmentFactory)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->apartmentFactory = $apartmentFactory;
    }

    #[Route('/apartment', name: 'app_apartment_list')]
    public function index(): Response
    {
        $apartments = $this->apartmentRepository->findAll();

        return $this->render('admin/apartment/list.html.twig', [
            'apartments' => $apartments
        ]);
    }

    #[Route('/apartment/create', name: 'app_apartment_create')]
    public function create(Request $request): Response
    {
        $newApartmentsModel = new ApartmentModel();
        $form = $this->createForm(ApartmentType::class, $newApartmentsModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apartment = $this->apartmentFactory->createBuilding($newApartmentsModel);
            $this->apartmentRepository->save($apartment);

            $this->addFlash('success', 'Apartman byl úspěšně přidán');
            return $this->redirectToRoute('app_apartment_list', []);
        }
        return $this->render('admin/apartment/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/apartment/edit/{id}', name: 'app_apartment_edit')]
    public function update(Apartment $apartment, Request $request): Response
    {
        $editApartment = ApartmentModel::createFromEntity($apartment);

        $form = $this->createForm(ApartmentType::class, $editApartment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $apartment->mapFromModel($editApartment);
            $this->apartmentRepository->save($apartment);

            $this->addFlash('success', 'Apartmán uspěšně upraven.');
            return $this->redirectToRoute('app_apartment_list', []);
        }

        return $this->render('admin/apartment/edit.html.twig', [
            'apartment' => $apartment,
            'form' => $form->createView()
        ]);
    }

    #[Route('/apartment/{id}/delete', name: 'app_apartment_delete')]
    public function delete( Apartment $apartment ): Response
    {
        $this->apartmentRepository->remove($apartment);

        $this->addFlash('success', 'Apartmán byla úspěšně smazán.');

        return $this->redirectToRoute('app_apartment_list');
    }
}
