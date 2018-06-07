<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class MeetingRoom
 *
 * @package App\DataFixtures
 */
class MeetingRoom extends Fixture
{
    /**
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $meetingRoom  = new \App\Entity\MeetingRoom();
        $meetingRoom->setName('First');

        $this->addReference('firstMeetingRoom', $meetingRoom);

        $manager->persist($meetingRoom);

        $manager->flush();
    }
}
