<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Booking extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 10; $i++) {
            $booking = new \App\Entity\Booking();

            $booking->setUser($this->getReference('admin'));
            $booking->setStartTime(new \DateTime("+$i hour"));
            $nextI = $i+1;
            $booking->setEndTime(new \DateTime("+{$nextI} hour"));
            $booking->setMeetingRoom($this->getReference('firstMeetingRoom'));

            $manager->persist($booking);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [Users::class];
    }
}
