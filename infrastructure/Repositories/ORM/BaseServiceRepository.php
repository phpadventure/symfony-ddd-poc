<?php

namespace Infrastructure\Repositories\ORM;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Exceptions\InfrastructureException;
use Infrastructure\Factories\BaseFactory;
use Infrastructure\Models\ArraySerializable;
use Infrastructure\Models\Collection;
use Infrastructure\Models\CollectionWalk;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseServiceRepository extends ServiceEntityRepository implements RepositoryInterface
{
    private $factory;

    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    abstract public function createFactory(): BaseFactory;

    public function save(ArraySerializable $entity): ArraySerializable
    {
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
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

    public function batchSave(Collection $entities)
    {
        $entities->walk(
            new class($this->_em) implements CollectionWalk
            {
                private $entityManager;

                public function __construct(EntityManagerInterface $entityManager)
                {
                    $this->entityManager = $entityManager;
                }

                public function invoke(ArraySerializable $model, $key): void
                {
                    $this->entityManager->merge($model);
                }
            }
        );

        $this->_em->flush();
    }

    public function load(array $criteria = [], array $orderBy = null, $limit = null, $offset = null): Collection
    {
        return new Collection($this->findBy($criteria, $orderBy, $limit, $offset));
    }

    public function create(array $data): ArraySerializable
    {
        return $this->save($this->build($data));
    }

    public function update(array $criteria, array $data): ArraySerializable
    {
        $entity = $this->findOneBy($criteria);

        if (!$entity) {
            throw new NotFoundHttpException($this->_entityName . ' not found');
        }

        if (!$entity instanceof ArraySerializable) {
            throw new InfrastructureException();
        }

        $this->_em->merge(
            $entity = $this->build(array_merge($entity->toArray(), $data))
        );

        $this->_em->flush();

        return $entity;
    }

    public function deleteBy(array $criteria)
    {
        $entity = $this->_em->getPartialReference($this->getEntityName(), $criteria);
        $this->delete($entity);
    }

    protected function build(array $data): ArraySerializable
    {
        return $this->factory()->create($data);
    }

    private function factory(): BaseFactory
    {
        if ($this->factory === null) {
            return $this->factory = $this->createFactory();
        }

        return $this->factory;
    }
}
