<?php

namespace App\Models;

use Infrastructure\Models\ArraySerializable;

class Car implements ArraySerializable
{
    const ENGINE = 'engine';
    const NAME = 'name';
    const TYPE = 'type';

    const NAME_BMW = 'bmw';
    const NAME_AUDI = 'audi';

    private $engine;
    private $name;
    private $type;

    public function __construct($engine, $name, $type)
    {
        $this->engine = $engine;
        $this->type = $type;
        $this->name = $name;
    }

    public function getName() : string
    {
        return  $this->name;
    }

    public function setType(string $type) : Car
    {
        $this->type = $type;
        return $this;
    }

    public function toArray(): array
    {
        return [
            self::ENGINE => $this->engine,
            self::NAME => $this->name,
            self::TYPE => $this->type,
        ];
    }
}