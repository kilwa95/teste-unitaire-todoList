<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\ItemService;
use App\Entity\Item;
use App\Entity\ToDoListService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\ItemRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;


class ItemTest extends KernelTestCase
{

     /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

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

    public function testStructureListByItem(){
        $entityManager= $this->createMock(EntityManagerInterface::class);
        $itemService = new ItemService($entityManager);
        $items =  $this->entityManager->getRepository(Item::class)->findAll();
        $toDoLists =  $this->entityManager->getRepository(ToDoListService::class)->findAll();
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
        $this->assertEquals($lists, $itemService->structureListByItem($toDoLists ,$items));

    
    }


    public function testSerializeListes()
    {
        $entityManager= $this->createMock(EntityManagerInterface::class);
        $itemService = new ItemService($entityManager);
        $lists =  $this->entityManager->getRepository(Item::class)->findAll();
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
        $this->assertEquals($array, $itemService->serializeListes($lists));

    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

}
