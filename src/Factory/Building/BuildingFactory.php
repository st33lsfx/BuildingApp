<?php

namespace App\Factory\Building;

use App\Entity\Building\Building;
use App\Model\Building\BuildingModel;


final class BuildingFactory
{

    public function createBuilding(BuildingModel $buildingModel): Building
    {
        $newBuilding = new Building();

        $newBuilding->setTitle($buildingModel->title);
        $newBuilding->setCity($buildingModel->city);
        $newBuilding->setAddress($buildingModel->address);
        $newBuilding->setDescriptionNumber($buildingModel->descriptionNumber);
        $newBuilding->setPostZip($buildingModel->postZip);

        return $newBuilding;
    }


}