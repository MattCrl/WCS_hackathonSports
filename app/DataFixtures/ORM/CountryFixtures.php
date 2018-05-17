<?php

namespace App\DataFixtures;

use AppBundle\Entity\Athlete;
use AppBundle\Entity\Country;
use AppBundle\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $country = new Country();
            $country->setCode($data['code']);
            $country->setName($data['name']);
            $manager->persist($country);

            if (isset($data['name_team'])) {
                $team = new Team();
                $team->setName($data['name_team']);
                $team->setCountry($country);
                $manager->persist($team);

                $athlete1 = new Athlete();
                $athlete1->setFirstname($data['firstname1']);
                $athlete1->setLastname($data['lastname1']);
                $athlete1->setImage($data['image1']);
                $athlete1->setTeam($team);
                $manager->persist($athlete1);

                $athlete2 = new Athlete();
                $athlete2->setFirstname($data['firstname2']);
                $athlete2->setLastname($data['lastname2']);
                $athlete2->setImage($data['image2']);
                $athlete2->setTeam($team);
                $manager->persist($athlete2);
            }
        }
        $manager->flush();
    }

    private function getData()
    {
        return [
            [
                'code' => 'PT',
                'name' => 'Portugal',
                'name_team' => 'Pony Hairy',
                'firstname1' => 'Twinkle',
                'lastname1' => 'Toes',
                'image1' => 'poney1.jpg',
                'firstname2' => 'Erza',
                'lastname2' => 'Scarlet',
                'image2' => 'poney12.jpg'

            ],
            [
                'code' => 'AR',
                'name' => 'Argentine',
                'name_team' => 'Pony Shiny',
                'firstname1' => 'Shining',
                'lastname1' => 'Star',
                'image1' => 'poney2.jpg',
                'firstname2' => 'Natsu',
                'lastname2' => 'Dragneel',
                'image2' => 'poney11.jpg'
            ],
            [
                'code' => 'AT',
                'name' => 'Austria',
                'name_team' => 'Pony Fairy',
                'firstname1' => 'Liquorice',
                'lastname1' => 'Dark Style',
                'image1' => 'poney3.jpg',
                'firstname2' => 'Meliodas',
                'lastname2' => 'Nanatsu',
                'image2' => 'poney10.jpg'
            ],
            [
                'code' => 'AU',
                'name' => 'Australia',
                'name_team' => 'My KangooPony',
                'firstname1' => 'Shadow',
                'lastname1' => 'Fang',
                'image1' => 'poney4.jpg',
                'firstname2' => 'Elisabeth',
                'lastname2' => 'Liones',
                'image2' => 'poney1.jpg'
            ],
            [
                'code' => 'BD',
                'name' => 'Bangladesh'
            ],
            [
                'code' => 'BE',
                'name' => 'Belgium',
                'name_team' => 'Pony Silly',
                'firstname1' => 'Midnight',
                'lastname1' => 'Hooves',
                'image1' => 'poney5.jpg',
                'firstname2' => 'Naruto',
                'lastname2' => 'Uzumaki',
                'image2' => 'poney9.jpg'
            ],
            [
                'code' => 'BL',
                'name' => 'Saint Barthélemy',
                'name_team' => 'My Quiet Pony',
                'firstname1' => 'Jhonny',
                'lastname1' => 'Storm',
                'image1' => 'poney6.jpg',
                'firstname2' => 'Son',
                'lastname2' => 'Goku',
                'image2' => 'poney3.jpg'
            ],
            [
                'code' => 'BR',
                'name' => 'Brazil',
                'name_team' => 'My Soccer Player Pony',
                'firstname1' => 'Rainbow',
                'lastname1' => 'Sparkle',
                'image1' => 'poney7.jpg',
                'firstname2' => 'Son',
                'lastname2' => 'Gohan',
                'image2' => 'poney2.jpg'
            ],
            [
                'code' => 'CA',
                'name' => 'Canada',
                'name_team' => 'Inapprehensible Pony',
                'firstname1' => 'Rocking',
                'lastname1' => 'Style',
                'image1' => 'poney8.jpg',
                'firstname2' => 'Sasuke',
                'lastname2' => 'Uchiha',
                'image2' => 'poney4.jpg'
            ],
            [
                'code' => 'CH',
                'name' => 'Switzerland',
                'name_team' => 'Pony Wealthy',
                'firstname1' => 'Morning',
                'lastname1' => 'Haste',
                'image1' => 'poney9.jpg',
                'firstname2' => 'Lucy',
                'lastname2' => 'heartfilia',
                'image2' => 'poney5.jpg'
            ],
            [
                'code' => 'CN',
                'name' => 'China',
                'name_team' => 'My Baby Pony',
                'firstname1' => 'Frozen',
                'lastname1' => 'Hoof',
                'image1' => 'poney10.jpg',
                'firstname2' => 'Kaneki',
                'lastname2' => 'Ken',
                'image2' => 'poney8.jpg'
            ],
            [
                'code' => 'DE',
                'name' => 'Germany',
                'name_team' => 'My Arryan Pony',
                'firstname1' => 'Little',
                'lastname1' => 'Style',
                'image1' => 'poney11.jpg',
                'firstname2' => 'Edward',
                'lastname2' => 'Elric',
                'image2' => 'poney6.jpg'
            ],
            [
                'code' => 'DK',
                'name' => 'Denmark',
                'name_team' => 'My Stoned Pony',
                'firstname1' => 'Flawless',
                'lastname1' => 'Spice',
                'image1' => 'poney12.jpg',
                'firstname2' => 'Shalltear',
                'lastname2' => 'Bloodfallen',
                'image2' => 'poney5.jpg'
            ],
            [
                'code' => 'ES',
                'name' => 'Spain',
                'name_team' => 'Bella Ciao Pony',
                'firstname1' => 'Blue',
                'lastname1' => 'Stream',
                'image1' => 'poney1.jpg',
                'firstname2' => 'Al',
                'lastname2' => 'Bedo',
                'image2' => 'poney10.jpg'
            ],
            [
                'code' => 'FR',
                'name' => 'France',
                'name_team' => 'Mon petit poney',
                'firstname1' => 'Ocean',
                'lastname1' => 'Sunset',
                'image1' => 'poney2.jpg',
                'firstname2' => 'John',
                'lastname2' => 'Doe',
                'image2' => 'poney12.jpg'
            ],
            [
                'code' => 'LU',
                'name' => 'Luxembourg'
            ],
            [
                'code' => 'MX',
                'name' => 'Mexico',
                'name_team' => 'My Pony Walking On The Wall',
                'firstname1' => 'Lucky',
                'lastname1' => 'Gem',
                'image1' => 'poney3.jpg',
                'firstname2' => 'Kara',
                'lastname2' => 'Danvers',
                'image2' => 'poney6.jpg'
            ],
            [
                'code' => 'PH',
                'name' => 'Philippines'
            ],
            [
                'code' => 'PL',
                'name' => 'Poland',
                'name_team' => 'My Vodka and My Pony',
                'firstname1' => 'Cinnamon',
                'lastname1' => 'Twirl',
                'image1' => 'poney4.jpg',
                'firstname2' => 'Barry',
                'lastname2' => 'Hallen',
                'image2' => 'poney11.jpg'
            ],
            [
                'code' => 'PR',
                'name' => 'Puerto Rico'
            ],
            [
                'code' => 'PY',
                'name' => 'Paraguay'
            ],
        ];
    }
}