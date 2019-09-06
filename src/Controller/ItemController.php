<?php
namespace App\Controller;

use Contexts\Order\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    /**
     * @Route("/items", methods={"GET"})
     * @param OrderServiceInterface $orderService
     * @return JsonResponse
     */
    public function items(OrderServiceInterface $orderService) : JsonResponse
    {
        return new JsonResponse($orderService->loadItems()->toArray());
    }

    /**
     * @Route("/items", methods={"POST"})
     * @param OrderServiceInterface $orderService
     * @param Request $request
     * @return JsonResponse
     */
    public function createItem(OrderServiceInterface $orderService, Request $request) : JsonResponse
    {
        return new JsonResponse($orderService->createItem($request->request->all())->toArray(), Response::HTTP_CREATED);
    }

    /**
     * @Route("/items/{id}", methods={"PUT"})
     * @param OrderServiceInterface $orderService
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateItem(OrderServiceInterface $orderService,int  $id, Request $request) : JsonResponse
    {
        return new JsonResponse($orderService->updateItem($id, $request->request->all())->toArray(), Response::HTTP_CREATED);
    }

    /**
     * @Route("/items/{id}", methods={"DELETE"})
     * @param OrderServiceInterface $orderService
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteItem(OrderServiceInterface $orderService,int $id, Request $request) : JsonResponse
    {
        $orderService->delete($id);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/items/{id}", methods={"GET"})
     * @param OrderServiceInterface $orderService
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function getItem(OrderServiceInterface $orderService,int $id, Request $request) : JsonResponse
    {
        return new JsonResponse($orderService->getByItemId($id)->toArray(), Response::HTTP_OK);
    }
}