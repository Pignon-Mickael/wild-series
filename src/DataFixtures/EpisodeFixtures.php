<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'Je suis Luffy ! Celui qui deviendra roi des pirates !',
            'number' => 1,
            'synopsis' => 'Lors de son exécution publique, Gol D. Roger, le Roi des Pirates, défie le monde entier de 
            trouver son trésor, le One Piece. Monkey D. Luffy, un garçon impulsif, part en quête d’un équipage.',
            'season' => 4
        ],
        [
            'title' => 'Le grand manieur de sabre ! Roronoa Zoro, chasseur de pirates',
            'number' => 2,
            'synopsis' => 'Accompagné de Kobby, Luffy part à la recherche du célèbre chasseur de primes Roronoa Zoro. Le
             garçon au chapeau de paille est bien déterminé à en faire un membre de son équipage.',
            'season' => 4
        ],
        [
            'title' => 'Le monde de l\'épée',
            'number' => 1,
            'synopsis' => 'Aujourd\'hui est un grand jour : celui du lancement officiel de Sword Art Online, l\'un des 
            jeux vidéo les plus attendus de tous les temps.',
            'season' => 0
        ],
        [
            'title' => 'Beater',
            'number' => 2,
            'synopsis' => 'Bien que les joueurs soient bloqués dans le jeu depuis un mois, ils n\'ont pas encore terminé
             le premier étage, et 2 000 personnes ont déjà trouvé la mort.',
            'season' => 0
        ],
        [
            'title' => 'L\'hiver vient',
            'number' => 1,
            'synopsis' => 'Au delà d\'un gigantesque mur de protection de glace dans le nord de Westeros. Robert Baratheon,
le roi, arrive avec son cortège au sud du mur de Winterfell pour demander de l\'aide à son vieil ami Eddard Stark. Dans 
le même temps, sur un autre continent, les derniers survivants de l\'ancien régime Targaryen sont à la recherche d\'une 
nouvelle alliance pour reprendre leur royaume de "l\'usurpateur" roi Robert...',
            'season' => 2
        ],
        [
            'title' => 'La route royale',
            'number' => 2,
            'synopsis' => 'Le roi Robert Baratheon et son entourage prennent la direction du Sud avec Eddard Stark et 
            ses filles Sansa et Arya. Sur la route, Arya a des ennuis avec le prince Joffrey, ce qui laisse à Eddard une
             décision difficile à prendre. Pendant ce temps, Jon Snow et Tyrion Lannister se dirigent vers le Mur, dans 
             le Nord, le premier pour rejoindre la Garde de nuit et le second par curiosité. A Essos, Daenerys apprend 
             ce que cela signifie d\'être mariée à un seigneur de guerre Dothraki. Sur les terres de Winterfell, Bran 
             Stark lutte pour ne pas mourir après sa chute...',
            'season' => 2
        ]
    ];

    /**
     * @var Slugify
     */
    private $slug;

    public function __construct(Slugify $slug)
    {
        $this->slug = $slug;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $val){
            $episode = new Episode();
            $episode->setTitle($val['title']);
            $episode->setSlug($this->slug->generate($val['title']));
            $episode->setNumber($val['number']);
            $episode->setSynopsis($val['synopsis']);
            $episode->setSeason($this->getReference('season_' . $val['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
