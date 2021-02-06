<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\ItemService;
use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;

class ItemTest extends TestCase
{
    public function testSaveItem()
    {
        $body = [
            "name" =>  "khaled",
            "content" =>  "developpeur",
        ];
        $entityManager= $this->createMock(EntityManagerInterface::class);
        $item  = new Item();
        $temService = new ItemService($entityManager);

        $item->setName($body['name']);
        $item->setContent($body['content']);
        $entityManager
            ->expects($this->once())
            ->method('persist')
            ->will($this->returnValue(true));
        $this->assertInstanceOf('App\Entity\Item' ,$temService->saveItem($body));     

    }
}
