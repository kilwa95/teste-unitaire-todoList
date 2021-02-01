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
        $this->entityManager->flush();
        return $item ;
    }
  
}