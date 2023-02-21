<?php

namespace App\Repository\Person;

use App\Entity\Person\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Person>
 *
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    private $entityManager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Person::class);
        $this->entityManager = $entityManager;
    }
    public function save(Person $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

    }

    public function remove(Person $entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
