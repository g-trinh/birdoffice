<?php

namespace App\Manager\InMemory;

use App\Entity\Room;

class RoomDataManager extends InMemoryAbstractDataManager
{

    public function __construct()
    {
        $roomReflectionClass = new \ReflectionClass(Room::class);
        $idPropertyReflection = $roomReflectionClass->getProperty('id');
        $idPropertyReflection->setAccessible(true);

        for ($i = 200; $i < 210; $i++) {
            $room = new Room();
            $idPropertyReflection->setValue($room, $i);
            $room->setNumber($i);

            $this->data[$i] = $room;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data)
    {
        return $data instanceof Room;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $parameters)
    {
        if (isset($parameters['id'])) {
            return $this->data[$parameters['id']];
        }

        return null;
    }
}