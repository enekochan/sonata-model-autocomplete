<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use AppBundle\Entity\State;
use AppBundle\Entity\City;

class CityData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $om
     */
    public function load(ObjectManager $om)
    {
        foreach ($this->getCities() as $city) {
            $c = new City();
            $c->setName($city['name']);
            $c->setStatus(City::STATUS_ENABLED);
            $om->persist($c);
        }

        $om->flush();
    }

    private function getCities()
    {
        return array(
            array('state_id' => 28, 'name' => 'Madrid'),
            array('state_id' => 48, 'name' => 'Bilbao'),
        );
    }

    /**
     * getOrder
     *
     * @return integer
     */
    public function getOrder()
    {
        return 101;
    }
}
