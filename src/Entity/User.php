<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Booking[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="user")
     */
    protected $bookings;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->bookings = new ArrayCollection();
    }

    /**
     * @return Booking[]
     */
    public function getBookings(): array
    {
        return $this->bookings;
    }

    /**
     * @param Booking[] $bookings
     */
    public function setBookings(array $bookings): void
    {
        $this->bookings = $bookings;
    }
}
