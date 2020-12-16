<?php

namespace App\Tests;

use App\Entity\User;


use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsValid()
    {
        $user = new User();
        $user->setNom('abdulhalim');
        $user->setPrenom('khaled');
        $user->setPrenom('khaled');
        $user->setEmail('khaled@gmail.com');
        $user->setPassword('m');
        $user->setAge(13);
        $this->assertTrue($user->isValid());
    }


    public function testIsValidException()
    {
        $user = new User();
        $user->setNom('abdulhalim');
        $user->setPrenom('khaled');
        $user->setPrenom('khaled');
        $user->setEmail('khaled@gmail.com');
        $user->setPassword('');
        $user->setAge(10);
        $this->expectException('LogicException');
        $this->assertTrue($user->isValid());
    }
}
