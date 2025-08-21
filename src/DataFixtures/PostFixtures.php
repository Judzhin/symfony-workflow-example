<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class PostFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($p = 0; $p < 32; $p++) {
            $post = (new Post)
                ->setTitle($faker->sentence(50))
                ->setDescription($faker->paragraphs(6, true))
                ->setType(Post::TYPE_PUBLISHED)
                ->setPublishedAt($faker->dateTimeThisYear());
            $manager->persist($post);
        }

        $manager->flush();
    }
}
