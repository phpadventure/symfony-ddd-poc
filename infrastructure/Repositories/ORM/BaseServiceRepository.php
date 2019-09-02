<?php


namespace Infrastructure\Repositories\ORM;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Models\ArraySerializable;
use Infrastructure\Models\Collection;
use Infrastructure\Models\CollectionWalk;

abstract class BaseServiceRepository extends ServiceEntityRepository
{
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function delete($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    public function persist($entity)
    {
        $this->_em->persist($entity);
    }

    public function remove($entity)
    {
        $this->_em->remove($entity);
    }

    public function flush($entity = null)
    {
        $this->_em->flush($entity);
    }

    public function bathSave(Collection $entities)
    {
        $entities->walk(new class($this->_em) implements CollectionWalk {
            private $entityManager;
            public function __construct(EntityManagerInterface $entityManager)
            {
                $this->entityManager = $entityManager;
            }

            public function invoke(ArraySerializable $model, $key): void
            {
                $this->entityManager->persist($model);
            }
        });

        $this->_em->flush();
    }
}