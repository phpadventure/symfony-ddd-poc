<?php


namespace Contexts\Order;


use Contexts\Order\Modules\Time\Models\Time;

interface OrderServiceInterface
{
    public function test() : string;

    public function time() : Time;
}