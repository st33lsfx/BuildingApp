<?php

namespace App\Controller;

use App\Repository\Apartment\ApartmentRepository;
use App\Repository\Building\BuildingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private BuildingRepository $buildingRepository;
    private ApartmentRepository $apartmentRepository;

    public function __construct(BuildingRepository $buildingRepository, ApartmentRepository $apartmentRepository)
    {
        $this->buildingRepository = $buildingRepository;
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * @Route("api/building/",name="api_list_buildings")
     */
    public function apiListBuildings(): Response
    {
        $buildings = $this->buildingRepository->findAll();
        $data = [];

        foreach ($buildings as $building) {
            $data[] = [
                'id' => $building->getId(),
                'title' => $building->getTitle(),
                'city' => $building->getCity(),
                'address' => $building->getAddress(),
                'description_number' => $building->getDescriptionNumber(),
                'post_zip' => $building->getPostZip()
            ];
        }
        return $this->json($data);
    }

    /**
     * @Route("api/apartment/{id}",name="api_list_apartment")
     */
    public function apiListApartment(): Response
    {
        $apartments = $this->apartmentRepository->findAll();
        $data = [];

        foreach ($apartments as $apartment) {
            $data[] = [
                'id' => $apartment->getId(),
                'building' => $apartment->getBuilding(),
                'person' => $apartment->getPerson(),
                'title' => $apartment->getTitle(),
                'size' => $apartment->getSize(),
                'cold_water_status' => $apartment->getColdWaterStatus(),
                'hot_water_status' => $apartment->getHotWaterStatus(),
                'gas_meter_status' => $apartment->getGasMeterStatus(),
                'square_meter' => $apartment->getSquareStatus()
            ];
        }
        return $this->json($data);
    }
}
