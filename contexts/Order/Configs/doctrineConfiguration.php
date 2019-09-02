<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;

/** @var $container ContainerBuilder */

$container->loadFromExtension('doctrine', [
    'orm' => [
        'auto_mapping' => true,
        'mappings' => [
            'Contexts\Order\Modules\Item\Models' => [
                'type'      => 'annotation',
                'dir'       => '%kernel.project_dir%/contexts/Order/Modules/Item/Models',
                'is_bundle' => false,
                'prefix'    => 'Contexts\Order\Modules\Item\Models',
                'alias'     => 'Order\Item',
            ],
        ],
    ],
]);