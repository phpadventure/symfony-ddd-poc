<?php

namespace Infrastructure\Models;


class Collection implements \IteratorAggregate, \Countable, ArraySerializable
{
    const ITEMS = 'items';

    /**
     * @var ArraySerializable[]
     */
    protected $collection = [];

    /**
     * Collection constructor.
     * @param ArraySerializable[] $collection
     */
    public function __construct(array $collection = [])
    {
        $this->populateCollection($collection);
    }

    /**
     * @return ArraySerializable[]
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param ArraySerializable $object
     *
     * @return $this
     */
    public function push(ArraySerializable $object)
    {
        $this->collection[] = $object;

        return $this;
    }

    /**
     * @param int $position
     * @param ArraySerializable $object
     *
     * @return $this
     */
    public function set($position, ArraySerializable $object)
    {
        $this->collection[$position] = $object;

        return $this;
    }

    /**
     * @param int $position
     *
     * @return ArraySerializable
     */
    public function get($position)
    {
        return $this->issetElement($position) ? $this->collection[$position] : null;
    }

    /**
     * @param int $position
     *
     * @return bool
     */
    public function issetElement($position)
    {
        return array_key_exists($position, $this->collection);
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->collection);
    }

    /**
     * @param int $position
     *
     * @return Collection
     */
    public function remove($position)
    {
        unset($this->collection[$position]);

        return $this;
    }

    /**
     * @return ArraySerializable
     */
    public function getFirst()
    {
        reset($this->collection);

        return count($this->collection) > 0 ? current($this->collection) : null;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $objectArray = [];
        foreach ($this->collection as $objectKey => $object) {
            $objectArray[$objectKey] = $object->toArray();
        }

        return [
            self::ITEMS => $objectArray,
        ];
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

    /**
     * @param $getterName
     *
     * @return $this
     */
    public function sortByEntityField($getterName)
    {
        usort($this->collection, function (ArraySerializable $a, ArraySerializable $b) use ($getterName) {
            return $a->$getterName() <=> $b->$getterName();
        });

        return $this;
    }

    /**
     * @param $getterName
     * @return $this
     */
    public function sortByEntityFieldDesc($getterName)
    {
        usort($this->collection, function (ArraySerializable $a, ArraySerializable $b) use ($getterName) {
            return $b->$getterName() <=> $a->$getterName();
        });

        return $this;
    }

    /**
     * @param $getterName
     *
     * @return array
     */
    public function getColumn($getterName)
    {
        $columnArray = [];
        foreach ($this->collection as $item) {
            $columnArray[] = $item->$getterName();
        }

        return $columnArray;
    }

    /**
     * @param $getterName
     * @return Collection
     */
    public function replaceKeys($getterName) : Collection
    {
        $collection = new Collection();
        foreach ($this->collection as $item) {
            $collection->set($item->$getterName(), $item);
        }

        return $collection;
    }

    /**
     * @param $getterName
     * @return $this
     */
    public function groupBy($getterName) : Collection
    {
        $groupedCollection = [];

        foreach ($this->collection as $key => $item) {
            if (!array_key_exists($item->$getterName(), $groupedCollection)) {
                $groupedCollection[$item->$getterName()] = new Collection();
            }

            /** @var Collection $nestedGroupedCollection */
            $nestedGroupedCollection = $groupedCollection[$item->$getterName()];

            $nestedGroupedCollection->set($key, $item);
        }

        return new Collection($groupedCollection);
    }

    /**
     * @param $limit
     * @return Collection
     */
    public function limit($limit)
    {
        return new Collection(array_slice($this->collection, 0, $limit, true));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public function merge(Collection $collection) : Collection
    {
        return new Collection(array_merge($this->collection, $collection->getCollection()));
    }

    /**
     * @param CollectionWalk $walkClosure
     * @return $this
     */
    public function walk(CollectionWalk $walkClosure)
    {
        array_walk($this->collection, [$walkClosure, 'invoke']);

        return $this;
    }

    /**
     * @param CollectionFilter $filterClosure
     * @return Collection
     */
    public function filter(CollectionFilter $filterClosure) : Collection
    {
        return new Collection(array_filter($this->collection, [$filterClosure, 'invoke'], ARRAY_FILTER_USE_BOTH));
    }

    /**
     * @param array $collection
     */
    private function populateCollection(array $collection): void
    {
        foreach ($collection as $item) {
            $this->push($item);
        }
    }

    /**
     * @return Collection
     */
    public function flashKeys()
    {
        return new Collection(array_values($this->collection));
    }
}