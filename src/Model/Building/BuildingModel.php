<?php

namespace App\Model\Building;

use App\Entity\Building\Building;

class BuildingModel
{

    public int $id;

    public ?string $title = null;

    public ?string $city = null;

    public ?string $address = null;

    public ?int $descriptionNumber = null;

    public ?string $postZip = null;

    public static function createFromEntity(Building $building): BuildingModel
    {
        $build = new self();

        $build->id = $building->getId();

        $build->title = $building->getTitle();

        $build->city = $building->getCity();

        $build->address = $building->getAddress();

        $build->descriptionNumber = $building->getDescriptionNumber();

        $build->postZip = $building->getPostZip();

        return $build;
    }


}