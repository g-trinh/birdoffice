<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Validator as AppAssert;

/**
 * Class Room
 *
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="reservations")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * @AppAssert\RoomExistsConstraint()
     */
    private $room;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_date", type="datetime")
     */
    private $arrivalDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_date", type="datetime")
     */
    private $departureDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="with_breakfast", type="boolean")
     */
    private $withBreakfast;

    /**
     * @var int
     *
     * @ORM\Column(name="persons_count", type="integer")
     */
    private $personsCount;

    public function __construct()
    {
        $this->withBreakfast = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param Room $room
     * @return Reservation
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * @param \DateTime $arrivalDate
     * @return Reservation
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * @param \DateTime $departureDate
     * @return Reservation
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWithBreakfast()
    {
        return $this->withBreakfast;
    }

    /**
     * @param bool $withBreakfast
     * @return Reservation
     */
    public function setWithBreakfast(bool $withBreakfast)
    {
        $this->withBreakfast = $withBreakfast;
        return $this;
    }

    /**
     * @return int
     */
    public function getPersonsCount()
    {
        return $this->personsCount;
    }

    /**
     * @param int $personsCount
     * @return Reservation
     */
    public function setPersonsCount($personsCount)
    {
        $this->personsCount = $personsCount;
        return $this;
    }
}