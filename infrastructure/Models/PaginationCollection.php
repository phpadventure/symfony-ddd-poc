<?php

namespace Infrastructure\Models;

class PaginationCollection extends Collection
{
    const TOTAL_RESULTS = 'totalResults';
    const LIMIT = 'limit';
    const OFFSET = 'offset';
    
    /**
     * @var int
     */
    private $totalResult = 0;

    /**
     * @var int
     */
    private $limit = 0;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var Collection
     */
    private $collection;

    /**
     * PaginationCollection constructor.
     * @param Collection $collection
     * @param $totalResult
     * @param $limit
     * @param $offset
     */
    public function __construct(Collection $collection, $totalResult, $limit, $offset)
    {
        $this->collection = $collection->limit($limit);
        $this->totalResult = $totalResult;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return array_merge(
            [
            self::TOTAL_RESULTS => $this->getTotalResult(),
            self::LIMIT => $this->getLimit(),
            self::OFFSET => $this->getOffset()
            ],
            $this->getCollection()->toArray()
        );
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return int
     */
    public function getTotalResult()
    {
        return $this->totalResult;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $totalResult
     */
    public function setTotalResult(int $totalResult): void
    {
        $this->totalResult = $totalResult;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    #TODO override methods of parent collection and create interface
}