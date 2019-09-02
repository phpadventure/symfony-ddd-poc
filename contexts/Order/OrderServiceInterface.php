<?php


namespace Contexts\Order;


use Contexts\Order\Modules\Time\Models\Time;
use Infrastructure\Models\Collection;

interface OrderServiceInterface
{
    public function test() : string;

    public function time() : Time;

    public function loadItems() : Collection;
}