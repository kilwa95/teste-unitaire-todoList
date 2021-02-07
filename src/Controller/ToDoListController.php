<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\ToDoListService;
use App\Repository\ToDoListServiceRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;


class ToDoListController extends AbstractController
{
     /**
     * @Rest\Post("/todolist")
     * @param Request $request
     */
    public function postTodolist(Request $request,MailerInterface $mailer): Response
    {
        $body = json_decode($request->getContent(), true);
        $response = new JsonResponse();
        if($body){
            $list = new ToDoListService($mailer);
            $list->setName($body['name']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($list);
            $em->flush();
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(201);
            $response->setData(' new todolist added ');
            return $response;
        }
        else{
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(204);
            $response->setData('le body  est vide');
            return $response;
        }
       
    }

     /**
     * @Rest\Delete("/todolist/{id}")
     * @param Request $request
     */
    public function deleteTodolist(int $id, ToDoListServiceRepository $toDoListServiceRepository,ItemRepository $itemRepository): Response
    {
        $response = new JsonResponse();
        if($id){
            $list = $toDoListServiceRepository->find($id);
            $em = $this->getDoctrine()->getManager();
            $em->remove($list);
            $em->flush();
            $response->setStatusCode(200);
            $response->setData('  todolist deleted ');
            return $response;
        }

        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(204);
        $response->setData('id not found');
        return $response;
    }

    /**
     * @Rest\Patch("/todolist/{id}")
     * @param Request $request
     */

    public function patchTodolist(Request $request,int $id, ToDoListServiceRepository $toDoListServiceRepository): Response
    {
        $response = new JsonResponse();
        $body = json_decode($request->getContent(), true);
        if($id && $body){
         $list = $toDoListServiceRepository->find($id);
         $em = $this->getDoctrine()->getManager();
         $list->setName($body['name']);
         $em->flush();
         $response->setStatusCode(200);
         $response->setData(' todolist Updated ');
         return $response;

        }
        else{
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(204);
            $response->setData('id ou body is empty');
            return $response;
        }

    }

}
