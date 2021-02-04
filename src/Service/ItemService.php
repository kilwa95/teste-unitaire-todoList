<?php

namespace App\Service;
use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;


class ItemService
{

    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function serialize($items)
    {
        $itemsJson = [];
        foreach( $items as  $item){
            $itemObject = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'content' => $item->getContent(),
                'date' => $item->getDate(),
            ];
            $itemsJson[]= $itemObject;
            }
        return $itemsJson;
    }

    public function saveItem($body)
    {
        $item  = new Item();
        $item->setName($body['name']);
        $item->setContent($body['content']);
        $this->entityManager->persist($item);
        return $item ;
    }

    public function structureListByItem($toDoLists, $items)
    {
        $lists = [];
        foreach ( $toDoLists as  $toDoList) {
            $id = $toDoList->getId();
            $name = $toDoList->getName();

        if(!array_key_exists( $id, $lists)) {
            $lists[$name] = [];           
        } 

        foreach ($items as $item) {
            $idTodo = $item->getToDoListService()->getId();
        if( $idTodo ===  $id){
             array_push($lists[$name], $item);
        }
        }
        }
        return $lists;
    }

    public function serializeListes($lists){
        $array = [];
        foreach( $lists as  $index=>$list){
            foreach( $list as $key=> $item){
                $Object = [ 
                    'id' => $item->getId(),
                    'name' => $item->getName(),
                    'content' => $item->getContent(),
                    'date' => $item->getDate(),
                ];
    
                $array[$index][]= $Object;
            }
        
        }
        return $array;
    }


}