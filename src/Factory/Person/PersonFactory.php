<?php

namespace App\Factory\Person;

use App\Entity\Person\Person;
use App\Model\Person\PersonModel;

class PersonFactory
{

    public function createPerson(PersonModel $personModel): Person
    {
        $newPerson = new Person();

        $newPerson->setFirstName($personModel->firstName);
        $newPerson->setLastName($personModel->lastName);
        $newPerson->setPhone($personModel->phone);
        $newPerson->setEmail($personModel->email);

        return $newPerson;
    }

}