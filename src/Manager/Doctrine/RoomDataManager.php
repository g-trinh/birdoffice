<?php

namespace App\Manager\Doctrine;

use App\Entity\Room;

class RoomDataManager extends DoctrineAbstractDataManager
{
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
        return $this->entityManager->getRepository(Room::class)
            ->findOneBy($parameters);
    }
}