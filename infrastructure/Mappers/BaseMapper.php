<?php


namespace Infrastructure\Mappers;

use Infrastructure\Models\ArraySerializable;
use Infrastructure\Models\Collection;
use Infrastructure\Models\CollectionFactory;
use Infrastructure\Models\PaginationCollection;
use Infrastructure\Models\PaginationData;

abstract class BaseMapper
{
    abstract protected function buildObject(array $data) : ArraySerializable;

    /**
     * @param array $objectsParams
     * @param $totalCount
     * @param $limit
     * @param $offset
     * @return PaginationCollection
     */
    protected function buildPaginationCollection(array $objectsParams, $totalCount, $limit, $offset) : PaginationCollection
    {
        return (new CollectionFactory())
            ->createWithPaginationFromArray(
                $objectsParams,
                new PaginationData($totalCount, $limit, $offset),
                function (array $objectParam) {
                    return $this->buildObject($objectParam);
                }
            );
    }

    /**
     * @param array $objectsParams
     * @return Collection
     */
    protected function buildCollection(array $objectsParams) : Collection
    {
        return (new CollectionFactory())->create(
            $objectsParams,
            function (array $objectParam) {
                return $this->buildObject($objectParam);
            }
        );
    }
}
