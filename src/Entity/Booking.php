<?php

namespace App\Entity;

use App\Traits\DoctrineCreatedUpdatedTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    use DoctrineCreatedUpdatedTrait;

    /**
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     *
     * @var MeetingRoom
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MeetingRoom", fetch="EAGER")
     */
    private $meetingRoom;

    /**
     *
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime")
     */
    private $startTime;

    /**
     *
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime")
     */
    private $endTime;

    /**
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     *
     * @return \DateTime
     */
    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    /**
     *
     * @param \DateTime $startTime
     */
    public function setStartTime(\DateTime $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     *
     * @return \DateTime
     */
    public function getEndTime(): \DateTime
    {
        return $this->endTime;
    }

    /**
     *
     * @param \DateTime $endTime
     */
    public function setEndTime(\DateTime $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     *
     * @return MeetingRoom
     */
    public function getMeetingRoom(): MeetingRoom
    {
        return $this->meetingRoom;
    }

    /**
     *
     * @param MeetingRoom $meetingRoom
     */
    public function setMeetingRoom(MeetingRoom $meetingRoom): void
    {
        $this->meetingRoom = $meetingRoom;
    }
}
