<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Article;
use App\Entity\Avis;
use App\Entity\Categorie;
use App\Entity\Utilisateur;


use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();


        for ($i = 0; $i < 5; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setPseudo($faker->name());
            $utilisateur->setMail($faker->email());
            $utilisateur->setMdp($faker->password());
            $manager->persist($utilisateur);

            for ($j = 0; $j < 2; $j++) {
                $categorie = new Categorie();
                $categorie->setLibelle($faker->word());
                $manager->persist($categorie);

                for ($k = 0; $k < 3; $k++) {
                    $article = new Article();
                    $article->setTitre($faker->title());
                    $article->setContenu($faker->text());
                    $article->setDate($faker->dateTime());
                    $article->setUtilisateur($utilisateur);
                    $article->setMaCategorie($categorie);
                    $manager->persist($article);


                    for ($l = 0; $l < 2; $l++) {
                        $avis = new Avis();
                        $avis->setContenu($faker->text());
                        $avis->setNote(rand(0, 5));
                        $avis->setUtilisateur($utilisateur);
                        $avis->setArticle($article);

                        $manager->persist($avis);
                    }

                }
            }
        }






        $manager->flush();
    }
}
