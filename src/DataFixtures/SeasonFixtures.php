<?php


namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        [
            'number' => 1 ,
            'description' => 'Sword Art Online est un jeu de rôle en ligne massivement multijoueur en réalité virtuelle 
            (VRMMORPG), sorti en 2022. Avec le NerveGear, un casque de réalité virtuelle stimulant les cinq sens de 
            l\'utilisateur, les joueurs peuvent contrôler leur personnage dans le jeu avec leur esprit. Le jeu est 
            bêta-testé par 1 000 joueurs puis est enfin commercialisé.',
            'year' => 2012,
            'program' => 4
        ],
        [
            'number' => 2 ,
            'description' => 'Kirito est retourné à sa paisible vie de lycéen. Il n\'aspire désormais qu\'à une seule 
            chose : profiter pleinement de sa vie. Mais une nouvelle fois, le devoir le rappelle à l\'ordre…',
            'year' => 2013,
            'program' => 4
        ],
        [
            'number' => 1 ,
            'description' => 'A Westeros, un continent chimérique, de puissantes familles se disputent le trône de fer, 
            symbole de pouvoir absolu sur le royaume des Sept Couronnes. Plusieurs années après la rébellion ...',
            'year' => 2011,
            'program' => 0
        ],
        [
            'number' => 2 ,
            'description' => 'Les Sept Couronnes sont en guerre, et chaque camp cherche à nouer de nouvelles alliances. 
            Grâce au soutien de la puissante Maison Lannister, Joffrey Baratheon, héritier de Robert, détient ...',
            'year' => 2012,
            'program' => 0
        ],
        [
            'number' => 1 ,
            'description' => 'Dix ans après avoir dévoré l\'un des Fruits du Démon, le Gomu Gomu no Mi, qui le rend 
            élastique, Luffy part de son village pour se constituer un équipage et trouver le One Piece, trésor caché ...',
            'year' => 1999,
            'program' => 1
        ],
        [
            'number' => 2 ,
            'description' => 'Luffy rencontre Laboon, une baleine géante, après avoir traversé « Reverse Mountain » à 
            l\'entrée de Grand Line et lui promis de revenir la voir pour terminer son combat amical contre elle.',
            'year' => 2001,
            'program' => 1
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $val) {
            $season = new Season();
            $season->setNumber($val['number']);
            $season->setDescription($val['description']);
            $season->setYear($val['year']);
            $season->setProgram($this->getReference('program_' . $val['program']));
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }
        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            ProgramFixtures::class
        ];
    }
}
