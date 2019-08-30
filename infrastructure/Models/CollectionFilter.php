<?php


namespace Infrastructure\Models;


interface CollectionFilter
{
    public function invoke(ArraySerializable $model, $key) : bool;
}