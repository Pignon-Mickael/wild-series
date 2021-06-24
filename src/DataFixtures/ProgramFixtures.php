<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'Game Of Thrones',
            'summary' => 'Il y a très longtemps, à une époque oubliée, une force a détruit l\'équilibre des saisons. 
            Dans un pays où l\'été peut durer plusieurs années et l\'hiver toute une vie, des forces sinistres et 
            surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, 
            protégeant le Royaume de toute créature pouvant provenir d\'au-delà du Mur protecteur, n\'a plus les ressources
             nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s\'abat sur le
              Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent 
              sur le continent pour s\'emparer du Trône de Fer, le symbole du pouvoir absolu.',
            'poster' => 'https://cdn.radiofrance.fr/s3/cruiser-production/2019/04/3de4b702-38df-4410-8b6b-160a4872002d/838_gameofthrones8-20-posters_1.jpg',
            'category' => 1,
            'country' => 'Etats-uni, Royaume-uni',
            'year' => 2011,
        ],
        [
            'title' => 'One Piece',
            'summary' => 'Il fut un temps où Gold Roger était le plus grand de tous les pirates, le "Roi des Pirates" 
            était son surnom. A sa mort, son trésor d\'une valeur inestimable connu sous le nom de "One Piece" fut caché 
            quelque part sur "Grand Line". De nombreux pirates sont partis à la recherche de ce trésor mais tous sont morts avant 
            même de l\'atteindre. Monkey D. Luffy rêve de retrouver ce trésor légendaire et de devenir le nouveau "Roi des Pirates". 
            Après avoir mangé un fruit du démon, il possède un pouvoir lui permettant de réaliser son rêve. Il lui faut maintenant 
            trouver un équipage pour partir à l\'aventure !',
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
        ],
        [
            'title' => 'Sword Art Online',
            'summary' => 'Le monde prend la forme d\'un château flottant géant appelé Aincrad, comportant 100 paliers. 
            Chaque étage dispose d\'un cadre de style médiéval et un donjon avec un boss qui doit être vaincu pour que 
            les joueurs puissent accéder à l\'étage supérieur. Comme la plupart des jeux de rôle, le jeu propose un 
            système de niveau. Cependant, après la période de bêta test, le créateur du jeu a activé un système pour 
            piéger les joueurs à l\'intérieur d\'Aincrad, empêchant toute déconnexion. Pour pouvoir quitter le jeu, il 
            faut que quelqu\'un le finisse. Si les joueurs meurent dans le jeu ou si leurs casques d\'immersion 
            virtuelle sont enlevés de force, leur cerveau reçoit un flux de micro-ondes entraînant la mort.',
            'poster' => 'https://fr.web.img6.acsta.net/pictures/19/07/09/11/04/5921608.jpg',
            'category' => 0,
            'country' => 'Japon',
            'year' => 2012
        ]
    ];
    /**
     * @var Slugify
     */
    private $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $val) {
            $program = new Program();
            $program->setTitle($val['title']);
            $program->setSlug($this->slug->generate($val['title']));
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
