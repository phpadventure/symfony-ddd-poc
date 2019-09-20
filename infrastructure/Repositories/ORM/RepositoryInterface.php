<?php

namespace Infrastructure\Repositories\ORM;

use Infrastructure\Models\ArraySerializable;
use Infrastructure\Models\Collection;

interface RepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);
    public function findOneBy(array $criteria, array $orderBy = null);
    public function findAll();
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function create(array $data) : ArraySerializable;
    public function update(array $criteria, array $data) : ArraySerializable;

    public function save(ArraySerializable $entity) : ArraySerializable;
    public function delete($entity);

    public function persist($entity);
    public function remove($entity);
    public function flush($entity);

    public function load(array $criteria = [], array $orderBy = null, $limit = null, $offset = null): Collection;

    public function batchSave(Collection $entities);

    public function deleteBy(array $criteria);
}
