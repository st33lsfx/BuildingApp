<?php

namespace App\Factory\Apartment;

use App\Entity\Apartments\Apartment;
use App\Entity\Building\Building;
use App\Model\Apartment\ApartmentModel;

class ApartmentFactory
{

    public function createBuilding(ApartmentModel $apartmentModel): Apartment
    {
        $newApartment = new Apartment();

        $newApartment->setTitle($apartmentModel->title);
        $newApartment->setBuilding($apartmentModel->building);
        $newApartment->setPerson($apartmentModel->person);
        $newApartment->setSize($apartmentModel->size);
        $newApartment->setColdWaterStatus($apartmentModel->coldWaterStatus);
        $newApartment->setHotWaterStatus($apartmentModel->hotWaterStatus);
        $newApartment->setGasMeterStatus($apartmentModel->gasMeterStatus);
        $newApartment->setSquareStatus($apartmentModel->squareStatus);

        return $newApartment;
    }
}