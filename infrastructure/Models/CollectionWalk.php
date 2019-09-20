<?php


namespace Infrastructure\Models;

interface CollectionWalk
{
    public function invoke(ArraySerializable $model, $key) : void;
}
