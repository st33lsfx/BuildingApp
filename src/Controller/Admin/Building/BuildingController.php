<?php

namespace App\Controller\Admin\Building;

use App\Controller\BaseController;
use App\Entity\Building\Building;
use App\Factory\Building\BuildingFactory;
use App\Form\Building\BuildingType;
use App\Model\Building\BuildingModel;
use App\Repository\Building\BuildingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingController extends AbstractController
{

    private BuildingRepository $buildingRepository;
    private BuildingFactory $buildingFactory;

    public function __construct(BuildingRepository $buildingRepository, BuildingFactory $buildingFactory)
    {
        $this->buildingRepository = $buildingRepository;
        $this->buildingFactory = $buildingFactory;
    }

    #[Route('/building/', name: 'app_building_list')]
    public function list(): Response
    {
        $buildings = $this->buildingRepository->findAll();

        return $this->render('admin/building/list.html.twig', [
            'buildings' => $buildings,
        ]);
    }

    #[Route('/building/create/', name: 'app_building_create')]
    public function create( Request $request ): Response
    {
        $newBuildingModel = new BuildingModel();
        $form = $this->createForm(BuildingType::class, $newBuildingModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $building = $this->buildingFactory->createBuilding($newBuildingModel);
            $this->buildingRepository->save($building);

            $this->addFlash('success', 'Budova byla úspěšně přidána');
            return $this->redirectToRoute('app_building_list', []);
        }

        return $this->render('admin/building/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/building/edit/{id}', name: 'app_building_edit')]
    public function update(Building $building, Request $request): Response
    {
        $editBuilding = BuildingModel::createFromEntity($building);

        $form = $this->createForm(BuildingType::class, $editBuilding);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $building->mapFromModel($editBuilding);
            $this->buildingRepository->save($building);

            $this->addFlash('success', 'uspěšně upraveno');
            return $this->redirectToRoute('app_building_list', []);

        }
        return $this->render('admin/building/edit.html.twig', [
            'building' => $building,
            'form' => $form->createView()
        ]);
    }

    #[Route('/building/{id}/delete', name: 'app_building_delete')]
    public function delete( Building $building ): Response
    {
        $this->buildingRepository->remove($building);

        $this->addFlash('success', 'Budova byla úspěšně smazána.');

        return $this->redirectToRoute('app_building_list');
    }
}
