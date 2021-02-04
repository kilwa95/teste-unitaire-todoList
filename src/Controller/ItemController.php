<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Repository\ItemRepository;
use App\Repository\ToDoListServiceRepository;
use App\Service\ItemService;
use App\Entity\ToDoListService;
use App\Entity\Item;


class ItemController extends AbstractController
{
    
    /**
     * @Rest\Post("/items/todolist/{id}")
     * @param Request $request
     */
    public function saveItemeTodolist(int $id,ItemRepository $itemRepository,ItemService $itemService,Request $request,ToDoListServiceRepository $toDoListServiceRepository,MailerInterface $mailer)
    {
        $body = json_decode($request->getContent(), true);
        $list = $toDoListServiceRepository->find($id);
        $item = $itemService->saveItem($body);
        $list->addItem($item);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->json('item added in todolist');
        
    }

     /**
     * @Rest\Get("/items/todolist")
     */

    public function getodolistItems(ItemService $temService,ToDoListServiceRepository $toDoListServiceRepository,ItemRepository $itemRepository)
    {
            $toDoLists = $toDoListServiceRepository->findAll();
            $items =  $itemRepository->findAll();
            $lists = $temService->structureListByItem($toDoLists ,$items);
            $listJson = $temService->serializeListes($lists);
            // dd($lists);
            return $this->json( $listJson);

    }

}
