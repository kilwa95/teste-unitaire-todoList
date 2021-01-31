<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Item;


class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr-FR');
        for ($i=0; $i<100; $i++) {
            $item = new Item();
            $item->setName($faker->word());
            $item->setContent($faker->text());
            $item->setDate($faker->dateTime());
        }


        $manager->flush();
    }
}
