<?php

namespace Infrastructure\Repositories\ORM;

use Infrastructure\Models\Collection;

interface RepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null);
    public function findOneBy(array $criteria, array $orderBy = null);
    public function findAll();
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    public function save($entity);
    public function delete($entity);

    public function persist($entity);
    public function remove($entity);
    public function flush($entity);

    public function bathSave(Collection $entities);
}