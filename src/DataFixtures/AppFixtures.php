<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        /*for ($i=0; $i < 50; $i++) {
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
        }*/

        $user = new User();
        $user->setEmail('admin.admin@gmail.com');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'testtest'));
        $manager->persist($user);

        $manager->flush();
    }
}
