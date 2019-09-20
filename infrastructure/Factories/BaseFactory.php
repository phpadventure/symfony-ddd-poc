<?php

namespace Infrastructure\Factories;

use Infrastructure\Models\ArraySerializable;

abstract class BaseFactory
{
    abstract public function create(array $objectData) : ArraySerializable;

    protected function setDefaultIfNotExists($key, $default, $data)
    {
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }
}
