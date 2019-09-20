<?php
namespace App\Controller;

use App\Models\Car;
use Contexts\Order\OrderServiceInterface;
use Infrastructure\Models\ArraySerializable;
use Infrastructure\Models\Collection;
use Infrastructure\Models\CollectionFilter;
use Infrastructure\Models\CollectionWalk;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test")
     * @param OrderServiceInterface $orderService
     * @return JsonResponse
     */
    public function test(OrderServiceInterface $orderService) : JsonResponse
    {
        return new JsonResponse([$orderService->test()]);
    }

    /**
     * @Route("/time")
     * @param OrderServiceInterface $orderService
     * @return JsonResponse
     */
    public function time(OrderServiceInterface $orderService) : JsonResponse
    {
        return new JsonResponse($orderService->time()->toArray());
    }

    /**
     * @Route("/bmw-list")
     * @return JsonResponse
     */
    public function collectionWalk() : JsonResponse
    {
        $collection = new Collection([
            'a' => new Car('v8', Car::NAME_AUDI, ''),
            'b' => new Car('v8', Car::NAME_BMW, ''),
        ]);

        $bmwCollection = $collection->walk($this->walkBMW());

        return new JsonResponse($bmwCollection->toArray());
    }

    /**
     * @Route("/bmw")
     * @return JsonResponse
     */
    public function collectionFilter() : JsonResponse
    {
        $collection = new Collection([
            'a' => new Car('v8', Car::NAME_AUDI, 'sedan'),
            'b' => new Car('v8', Car::NAME_BMW, 'sedan'),
        ]);

        $bmwCollection = $collection->filter($this->filterBMW());

        return new JsonResponse($bmwCollection->toArray());
    }

    private function filterBMW() : CollectionFilter
    {
        return new class() implements CollectionFilter
        {
            public function invoke(ArraySerializable $model, $key): bool
            {
                /** @var Car $model */
                return ($model->getName() === Car::NAME_BMW);
            }
        };
    }

    private function walkBMW() : CollectionWalk
    {
        return new class() implements CollectionWalk
        {
            public function invoke(ArraySerializable $model, $key): void
            {
                /** @var Car $model */
                $model->setType('sedan');
            }
        };
    }
}
