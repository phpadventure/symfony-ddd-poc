<?php
namespace Infrastructure\Models;

class CollectionFactory
{
    public function create(array $objectsParams, \Closure $buildObject) : Collection
    {
        $collection = new Collection();
        foreach ($objectsParams as $objectParams) {
            $collection->push($buildObject($objectParams));
        }

        return $collection;
    }

    public function createWithPaginationFromArray(array $objectsParams, PaginationData $paginationData, \Closure $buildObject) : PaginationCollection
    {
        return new PaginationCollection(
            $this->create($objectsParams, $buildObject),
            $paginationData->totalCount(),
            $paginationData->limit(),
            $paginationData->offset()
        );
    }

    public function createWithPaginationFromCollection(Collection $collection, PaginationData $paginationData) : PaginationCollection
    {
        return new PaginationCollection($collection, $paginationData->totalCount(), $paginationData->limit(), $paginationData->offset());
    }
}