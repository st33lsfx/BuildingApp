<?php

namespace App\Model\Apartment;

use App\Entity\Apartments\Apartment;
use App\Entity\Building\Building;
use App\Entity\Person\Person;

class ApartmentModel
{

    public int $id;

    public ?string $title = null;

    public ?int $size = null;

    public ?float $coldWaterStatus = null;

    public ?float $hotWaterStatus = null;
    public ?float $gasMeterStatus = null;

    public ?float $squareStatus = null;

    public Building $building;

    public ?Person $person = null;

    public static function createFromEntity(Apartment $apartments): ApartmentModel
    {
        $newApartments = new self();

        $newApartments->id = $apartments->getId();
        $newApartments->title = $apartments->getTitle();
        $newApartments->size = $apartments->getSize();
        $newApartments->coldWaterStatus = $apartments->getColdWaterStatus();
        $newApartments->hotWaterStatus = $apartments->getHotWaterStatus();
        $newApartments->gasMeterStatus = $apartments->getGasMeterStatus();
        $newApartments->squareStatus = $apartments->getSquareStatus();
        $newApartments->building = $apartments->getBuilding();
        $newApartments->person = $apartments->getPerson();

        return $newApartments;
    }


}