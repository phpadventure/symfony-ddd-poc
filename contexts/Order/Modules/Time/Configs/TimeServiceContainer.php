<?php
namespace Contexts\Order\Modules\Time\Configs;

use Contexts\Order\Modules\Time\Factories\TimeFactory;
use Contexts\Order\Modules\Time\Mappers\TimeHttpMapper;
use Infrastructure\Models\Config;
use Infrastructure\Models\ServiceContainer;

class TimeServiceContainer extends ServiceContainer
{
    public function init(): ServiceContainer
    {
        $this->register('config', Config::class)->addArgument(include_once 'config.php');
        $this->register('timeHttpMapper', TimeHttpMapper::class)
            ->addArgument($this->get('config')->timeHttpMapper)
            ->addArgument($this->getApplicationContainer()->get('httpClient'))
            ->addArgument($this->getApplicationContainer()->get('requestFactory'))
            ->addArgument($this->getApplicationContainer()->get('jsonToArrayParsedResponse'))
            ->addArgument(new TimeFactory());

        return $this;
    }
}