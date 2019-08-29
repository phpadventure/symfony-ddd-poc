<?php
namespace App\Presentation;


use Contexts\Order\OrderServiceInterface;
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
    { throw new \Exception('ss');
        return new JsonResponse([$orderService->test()]);
    }
}