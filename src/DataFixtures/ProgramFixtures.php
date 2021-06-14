<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        [
            'title' => 'Game Of Thrones',
            'summary' => 'Dans le continent mythique de Westeros, plusieurs familles puissantes se battent pour le 
          contrôle des sept royaumes. Alors que le conflit éclate dans les royaumes des hommes, un ancien ennemi se lève
           une fois de plus pour les menacer tous. Pendant ce temps, les derniers héritiers d\'une dynastie récemment 
           usurpée complotent pour reprendre leur terre natale de l\'autre côté de la mer Narrow Sea.',
            'poster' => 'https://cdn.radiofrance.fr/s3/cruiser-production/2019/04/3de4b702-38df-4410-8b6b-160a4872002d/838_gameofthrones8-20-posters_1.jpg',
            'category' => 1,
            'country' => 'Etats-uni, Royaume-uni',
            'year' => 2011,
        ],
        [
            'title' => 'One Piece',
            'summary' => 'Il était une fois un pirate nommé Gol D. Roger. Il a obtenu richesse, gloire et pouvoir pour 
            gagner le titre de Roi des Pirates. Lorsqu\'il fut capturé et sur le point d\'être exécuté, il révéla que 
            son trésor appelé One Piece était caché quelque part à Grand Line. Tout le monde s\'est alors mis à la 
            recherche du trésor d\'une seule pièce, mais personne n\'a jamais trouvé l\'emplacement du trésor de Gol D. 
            Roger, et Grand Line était un endroit trop dangereux pour être franchi. Vingt-deux ans après la mort de Gol 
            D. Roger, un garçon nommé Monkey D. Luffy a décidé de devenir un pirate et de chercher le trésor de Gol D. 
            Roger pour devenir le prochain roi pirate.',
            'poster' => 'https://i0.wp.com/anitrendz.net/news/wp-content/uploads/2020/04/One-Piece.jpg?resize=696%2C392&ssl=1',
            'category' => 2,
            'country' => 'Japan',
            'year' => 1999,
        ],
        [
            'title' => 'The Walking Dead',
            'summary' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le 
            monde, ravagé par une épidémie, est envahi par les morts-vivants.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg',
            'category' => 4,
            'country' => 'Etats-uni',
            'year' => 2010,
        ],
        [
            'title' => 'Fear The Walking Dead',
            'summary' => 'La série se déroule au tout début de l\'épidémie relatée dans la série-mère The Walking Dead 
            et se passe dans la ville de Los Angeles, et non à Atlanta. 
             Madison est conseillère dans un lycée de Los Angeles. Depuis la mort de son mari, elle élève seule ses deux
              enfants : Alicia, excellente élève qui découvre les premiers émois amoureux, et son grand frère Nick qui a
               quitté la fac et a sombré dans la drogue.',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYWNmY2Y1NTgtYTExMS00NGUxLWIxYWQtMjU4MjNkZjZlZjQ3XkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_SY1000_CR0,0,666,1000_AL_.jpg',
            'category' => 4,
            'country' => 'Etats-uni',
            'year' => 2015
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $val) {
            $program = new Program();
            $program->setTitle($val['title']);
            $program->setSummary($val['summary']);
            $program->setCountry($val['country']);
            $program->setYear($val['year']);
            $program->setPoster($val['poster']);
            $program->setCategory($this->getReference('category_' . $val['category']));
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
        ];
    }
}
