<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 50; $i++) {
            $article = new Article();
            $article
                ->setPicture(null)
                ->setTitle("Article " . $i)
                ->setContent("Responsive web design is an approach to web design that makes web pages render well on a variety of devices and screen sizes.")
                ->setPublicationDate(new DateTime())
                ->setLastUpdateDate(new DateTime())
                ->setIsPublished(true)
                ->setUpdatedAt(new DateTime())
            ;

            $manager->persist($article);
        }

        $manager->flush();
    }
}
