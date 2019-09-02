<?php


namespace Infrastructure\Repositories\ORM;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class BaseServiceRepository extends ServiceEntityRepository
{
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}