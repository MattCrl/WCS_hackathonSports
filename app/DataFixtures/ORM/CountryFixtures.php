<?php

namespace App\DataFixtures;

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
                'name_team' => 'Pony Hairy'
            ],
            [
                'code' => 'AR',
                'name' => 'Argentine',
                'name_team' => 'Pony Shiny'
            ],
            [
                'code' => 'AT',
                'name' => 'Austria',
                'name_team' => 'Pony Fairy'
            ],
            [
                'code' => 'AU',
                'name' => 'Australia',
                'name_team' => 'My KangooPony'
            ],
            [
                'code' => 'BD',
                'name' => 'Bangladesh'
            ],
            [
                'code' => 'BE',
                'name' => 'Belgium',
                'name_team' => 'Pony Silly'
            ],
            [
                'code' => 'BL',
                'name' => 'Saint Barthélemy',
                'name_team' => 'My Quiet Pony'
            ],
            [
                'code' => 'BR',
                'name' => 'Brazil',
                'name_team' => 'My Soccer Player Pony'
            ],
            [
                'code' => 'CA',
                'name' => 'Canada',
                'name_team' => 'Inapprehensible Pony'
            ],
            [
                'code' => 'CH',
                'name' => 'Switzerland',
                'name_team' => 'Pony Wealthy'
            ],
            [
                'code' => 'CN',
                'name' => 'China',
                'name_team' => 'My Baby Pony'
            ],
            [
                'code' => 'DE',
                'name' => 'Germany',
                'name_team' => 'My Arryan Pony'
            ],
            [
                'code' => 'DK',
                'name' => 'Denmark',
                'name_team' => 'My Stoned Pony'
            ],
            [
                'code' => 'ES',
                'name' => 'Spain',
                'name_team' => 'Bella Ciao Pony'
            ],
            [
                'code' => 'FR',
                'name' => 'France',
                'name_team' => 'Mon petit poney'
            ],
            [
                'code' => 'LU',
                'name' => 'Luxembourg'
            ],
            [
                'code' => 'MX',
                'name' => 'Mexico',
                'name_team' => 'My Pony Walking On The Wall'
            ],
            [
                'code' => 'PH',
                'name' => 'Philippines'
            ],
            [
                'code' => 'PL',
                'name' => 'Poland',
                'name_team' => 'My Vodka and My Pony'
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