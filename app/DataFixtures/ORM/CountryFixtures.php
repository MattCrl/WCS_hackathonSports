<?php

namespace App\DataFixtures;

use AppBundle\Entity\Country;
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
        }
        $manager->flush();
    }

    private function getData()
    {
        return [
            [
                'code' => 'PT',
                'name' => 'Portugal'
            ],
            [
                'code' => 'AR',
                'name' => 'Argentine'
            ],
            [
                'code' => 'AT',
                'name' => 'Austria'
            ],
        ];
    }
}