<?php


namespace Infrastructure\Http\Response\JsonToArrayResponse;


interface ResponseArray
{
    public function getBody() : array ;
}