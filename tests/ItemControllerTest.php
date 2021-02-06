<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ItemControllerTest extends WebTestCase
{
    public function testGeTodolistItems()
    {
        $client = static::createClient();
        $client->request('GET', '/items/todolist');
        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPosTodolistItems()
    {

        $client = static::createClient();
        $client->request('POST', '/items/todolist/76',[],[], 
        ['CONTENT_TYPE' => 'application/json'],
        '{"name":"matiere","content":"react"}'
    );
        $this->assertResponseIsSuccessful();
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPosTodolistItemsNotFoundException()
    {

        $client = static::createClient();
        $client->request('POST', '/items/todolist/76');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
