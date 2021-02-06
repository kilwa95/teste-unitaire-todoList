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
            $response = new JsonResponse();
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(201);
            $response->setData(' new todolist added ');
            return $response;
        }
        else{
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(404);
            $response->setData('le body  est vide');
            return $response;
        }
       
    }
}
