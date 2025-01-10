<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Commentary;
use App\Entity\Category;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;
use \DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $tableauUser = [];
        $tableauCategory = [];
        $tableauArticle = [];

        $faker = Faker\Factory::create();
        for ($i=0; $i < 25; $i++) { 
            $user = new User();
            $user
            ->setFirstname($faker->firstname('male' | 'female'))
            ->setLastname($faker->lastname(''))
            ->setEmail($user->getFirstname().".".$user->getLastname() . "@" . $faker->freeEmailDomain())
            ->setPassword($this->hasher->hashPassword($user,'1234'))
            ->setAvatar($faker->imageUrl(640,480, 'cats', true))
            ->setRoles(['ROLE_USER']);
            $manager->persist($user);
            $tableauUser[]=$user;
        }

        //Category
        for ($i = 0; $i < 30; $i++) { 
            $category = new Category();
            $category->setLibele($faker->word());
            $manager->persist($category);
            $tableauCategory[] = $category;
        }
        //Article
        for ($i = 0; $i < 100; $i++) { 
            $article = new Article();
            $createAt = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now'));
            $article
                ->setTitle($faker->word())
                ->setContent($faker->paragraphs(3, true))
                ->setCreateAt($createAt)
                ->setUser($faker->randomElement($tableauUser));

            $randomCategory = $faker->randomElements($tableauCategory, 3);
            foreach ($randomCategory as $category) {
                $article->addCategory($category);
            }

            $manager->persist($article);
            $tableauArticle[] = $article;
        }
        //Commenaite
        foreach ($tableauArticle as $article) {
            for ($i = 0; $i < 10; $i++) {
                $commentary = new Commentary();

                $tempArticle = $article->getCreateAt()->format('Y-m-d H:i:s');

                $tempCommentaire = $faker->dateTimeBetween($tempArticle, 'now');
                $commentary
                    ->setContent($faker->sentence(10, true))
                    ->setCreateAt(DateTimeImmutable::createFromMutable($tempCommentaire))
                    ->setUser($faker->randomElement($tableauUser))
                    ->setArticle($article);

                $manager->persist($commentary);
            }
        }
        //dd($user);
        $manager->flush();
    }
}
