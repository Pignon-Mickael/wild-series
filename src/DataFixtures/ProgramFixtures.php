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
          'title'=> 'Game Of Thrones',
          'summary' => 'Dans le continent mythique de Westeros, plusieurs familles puissantes se battent pour le 
          contrôle des sept royaumes. Alors que le conflit éclate dans les royaumes des hommes, un ancien ennemi se lève
           une fois de plus pour les menacer tous. Pendant ce temps, les derniers héritiers d\'une dynastie récemment 
           usurpée complotent pour reprendre leur terre natale de l\'autre côté de la mer Narrow Sea.',
          'poster' => 'https://www.imdb.com/title/tt0944947/mediaviewer/rm4204167425/?ref_=ext_shr_lnk',
          'category' => 1,
          'country' => 'Etats-uni, Royaume-uni',
          'year' => 2011
      ],
        [
            'title'=> 'One Piece',
            'summary' => 'Il était une fois un pirate nommé Gol D. Roger. Il a obtenu richesse, gloire et pouvoir pour 
            gagner le titre de Roi des Pirates. Lorsqu\'il fut capturé et sur le point d\'être exécuté, il révéla que 
            son trésor appelé One Piece était caché quelque part à Grand Line. Tout le monde s\'est alors mis à la 
            recherche du trésor d\'une seule pièce, mais personne n\'a jamais trouvé l\'emplacement du trésor de Gol D. 
            Roger, et Grand Line était un endroit trop dangereux pour être franchi. Vingt-deux ans après la mort de Gol 
            D. Roger, un garçon nommé Monkey D. Luffy a décidé de devenir un pirate et de chercher le trésor de Gol D. 
            Roger pour devenir le prochain roi pirate.',
            'poster' => 'https://www.imdb.com/title/tt0388629/mediaviewer/rm1244280064/?ref_=ext_shr_lnk',
            'category' => 2,
            'country' => 'Japan',
            'year' => 1999
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $val) {
            $program = new Program();
            $program->setTitle($val['title']);
            $program->setSummary($val['summary']);
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
