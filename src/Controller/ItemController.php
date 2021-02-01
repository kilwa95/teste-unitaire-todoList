<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Repository\ItemRepository;
use App\Service\ItemService;


class ItemController extends AbstractController
{
    /**
     * @Rest\Get("/items")
     */
    public function getItemes(ItemRepository $itemRepository, ItemService $itemService)
    {
        $items = $itemRepository->findAll();
        $itemsJson = $itemService->serialize($items);
        return $this->json($itemsJson);
        
    }

   /**
     * @Rest\Post("/items")
     * @param Request $request
     */
    public function saveItemes(Request $request, ItemService $itemService)
    {
        $body = json_decode($request->getContent(), true);
        $item  = $itemService->saveItem($body);
        return $this->json($item);
        
    }
}
