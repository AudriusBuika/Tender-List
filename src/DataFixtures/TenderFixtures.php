<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Tender;

class TenderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $faker = \Faker\Factory::create();

        foreach(range(1,4000) as $x) {
            $tender = new Tender();
            $tender->setTitle($faker->sentence(mt_rand(1,3)));
            $tender->setDescription($faker->sentence(mt_rand(20,60)));
            $tender->updatedTimestamps();
            $manager->persist($tender);
        }

        $manager->flush();
    }
}
