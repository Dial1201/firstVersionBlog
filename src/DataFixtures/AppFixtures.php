<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Bluemmb\Faker\PicsumPhotosProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new PicsumPhotosProvider($faker));
        $users = [];

        for ($i = 0; $i < 30; $i++) {
            $user = new User;

            $user->setUsername($faker->name());
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastname());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTime());

            $manager->persist($user);

            $users[] = $user;
        }

        $categories = [];

        for ($i = 0; $i < 30; $i++) {
            $category = new Category;

            $category->setTitle($faker->sentence(3));
            $category->setDescription($faker->paragraph());
            $category->setImage($faker->imageUrl());

            $manager->persist($category);

            $categories[] = $category;
        }

        for ($i = 0; $i < 30; $i++) {
            $article = new Article;

            $article->setTitle($faker->word());
            $article->setContent($faker->text(1000));
            $article->setImage($faker->imageUrl(640, 480, true));
            $article->setCreatedAt(new \DateTime());
            $article->addCategory($categories[$faker->numberBetween(1, 29)]);
            $article->setAuthor($users[$faker->numberBetween(1, 29)]);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
