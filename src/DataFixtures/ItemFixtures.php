<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\ToDoListServiceFixtures;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Item;
use App\Entity\ToDoListService;



class ItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr-FR');
        $listes=  $manager->getRepository(ToDoListService::class)->findAll();

        for ($i=0; $i<100; $i++) {
            $item = new Item();
            $item->setName($faker->word());
            $item->setContent($faker->text());
            $item->setDate($faker->dateTime());
            $item->setToDoListService($listes[array_rand($listes)]);
            $manager->persist($item);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ToDoListServiceFixtures::class,
        ];
    }


   
}
