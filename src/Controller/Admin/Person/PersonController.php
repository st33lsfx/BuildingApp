<?php

namespace App\Controller\Admin\Person;

use App\Entity\Person\Person;
use App\Factory\Person\PersonFactory;
use App\Form\Person\PersonType;
use App\Model\Person\PersonModel;
use App\Repository\Person\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    private PersonRepository $personRepository;
    private PersonFactory $personFactory;
    public function __construct(PersonRepository $personRepository, PersonFactory $personFactory)
    {
        $this->personRepository = $personRepository;
        $this->personFactory = $personFactory;
    }

    #[Route('/person', name: 'app_person_list')]
    public function index(): Response
    {

        $persons = $this->personRepository->findAll();

        return $this->render('admin/person/list.html.twig', [
            'persons' => $persons,
        ]);
    }

    #[Route('/person/create', name: 'app_person_create')]
    public function create(Request $request): Response
    {
        $newPersonModel = new PersonModel();
        $form = $this->createForm(PersonType::class, $newPersonModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $this->personFactory->createPerson($newPersonModel);
            $this->personRepository->save($person);

            $this->addFlash('success', 'Osoba ' . $person->getFirstName() . ' byla uspěšně vytvořena.');
            return $this->redirectToRoute('app_person_list', []);
        }
        return $this->render('admin/person/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/person/edit/{id}', name: 'app_person_edit')]
    public function update(Person $person, Request $request): Response
    {
        $editPerson = PersonModel::createFromEntity($person);

        $form = $this->createForm(PersonType::class, $editPerson);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person->mapFromModel($editPerson);
            $this->personRepository->save($person);

            $this->addFlash('success', 'Osoba ' . $person->getFirstName() . ' ' . $person->getLastName() . ' byla uspěšně upravena.');
            return $this->redirectToRoute('app_person_list', []);
        }
        return $this->render('admin/person/edit.html.twig', [
            'person' => $person,
            'form' => $form->createView()
        ]);
    }
    #[Route('/person/{id}/delete', name: 'app_person_delete')]
    public function delete( Person $person ): Response
    {
        $this->personRepository->remove($person);

        $this->addFlash('success', 'Osoba ' . $person->getFirstName() . ' ' . $person->getLastName() . ' byla úspěšně smazán.');

        return $this->redirectToRoute('app_person_list');
    }
}
