<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr-FR');
        for ($i=0; $i<20; $i++) {
            $user = new User();
            $user->setNom($faker->name());
            $user->setPrenom($faker->firstName());
            $user->setDateNaissance($faker->dateTime());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setAge(rand(18, 59));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
