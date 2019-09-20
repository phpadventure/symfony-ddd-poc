<?php
namespace Contexts\Order\Modules\Item\Configs;

use App\Repository\ItemRepository;
use Infrastructure\Models\Config;
use Infrastructure\Models\ServiceContainer;

class ItemServiceContainer extends ServiceContainer
{
    public function init(): ServiceContainer
    {
        $this->register('config', Config::class)->addArgument(include_once 'config.php');
        $this->register('itemRepository', ItemRepository::class)
            ->addArgument($this->getApplicationContainer()->get('doctrine'));

        return $this;
    }
}
