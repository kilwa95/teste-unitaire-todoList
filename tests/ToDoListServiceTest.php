<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\ToDoListService;
use App\Entity\Item;
use App\Service\MailerService;



class ToDoListServiceTest extends TestCase
{
    public function testAddItem()
    {
        $list = new ToDoListService();
        $item = new Item();
        $item->setName('khaled');
        $item->setContent('abdulhalim');
        $this->assertInstanceOf('App\Entity\ToDoListService' ,$list->addItem($item));     
    }

    public function testAddItemExceptionName()
    {

        $list = new ToDoListService();
        $item = new Item();
        $item->setName('khaled');
        $item->setContent('abdulhalim');
        $this->expectException('LogicException');
        $this->assertInstanceOf('App\Entity\ToDoListService' ,$list->addItem($item)); 
        $this->assertInstanceOf('App\Entity\ToDoListService' ,$list->addItem($item));     
    
    }

    public function testAddItemExceptionDixitems()
    {
            $faker = \Faker\Factory::create('fr-FR');
            $list = new ToDoListService();
            for ($i = 0; $i < 11; $i++) {
            $item = new Item();
            $item->setName($faker->name());
            $item->setContent($faker->email());
            $this->expectException('LogicException');
            $this->assertInstanceOf('App\Entity\ToDoListService' ,$list->addItem($item));
            }

    }

    public function testAddItemExceptionEmail()
    {
            $faker = \Faker\Factory::create('fr-FR');
            $list = new ToDoListService();
            $email= $this->createMock(MailerService::class);
            $email
            ->expects($this->any())
            ->method('sendEmail')
            ->with("Vous ne peux plus qu’ajouter 2 items")
            ->will($this->returnValue('Vous ne peux plus qu’ajouter 2 items'));
            for ($i = 0; $i <= 8; $i++) {
            $item = new Item();
            $item->setName($faker->name());
            $item->setContent($faker->email());
            $this->expectException('LogicException');
            $this->assertInstanceOf('App\Entity\ToDoListService' ,$list->addItem($item));
            }

    }

   
}
