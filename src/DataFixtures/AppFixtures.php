<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Commentary;
use App\Entity\Category;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;


class AppFixtures extends Fixture
{
    // public function construct();
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user
        ->setFirstname('Quentin')
        ->setLastname('grenier')
        ->setEmail('test@test.com')
        ->setPassword('1234')
        ->setAvatar('profil.png')
        ->setRoles(['ROLE_USER']);
        dd($user);
        $manager->flush();
    }
}
