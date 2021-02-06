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
    public function saveTodolist(Request $request,MailerInterface $mailer): Response
    {
        $body = json_decode($request->getContent(), true);
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
}
