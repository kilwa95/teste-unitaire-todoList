<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ToDoListService;
use App\Entity\Item;



class ToDoListServiceFixtures extends Fixture
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer= $mailer;
    }


    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr-FR');
        for ($i=0; $i<5; $i++) {
        $ToDoList = new ToDoListService($this->mailer);
        $ToDoList->setName($faker->name());
        $manager->persist($ToDoList);

        }
        $manager->flush();

    }

}
