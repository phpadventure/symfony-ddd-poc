<?php

namespace Contexts\Order\Modules\Item\Repositories;

use Contexts\Order\Modules\Item\Models\Item;
use Infrastructure\Repositories\ORM\RepositoryInterface;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface ItemRepositoryInterface extends RepositoryInterface
{
}
