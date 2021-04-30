<?php

namespace App\DataFixture;

use App\Entity\Searches;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SearchesFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $searches = new Searches();
            $searches->setWord($faker->word());
            $searches->setSearches(mt_rand(0, 1000));
            $manager->persist($searches);
        }
        $manager->flush();
    }
}
