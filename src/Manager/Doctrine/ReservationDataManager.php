<?php

namespace App\Manager\Doctrine;

use App\Entity\Reservation;

class ReservationDataManager extends DoctrineAbstractDataManager
{
    /**
     * {@inheritdoc}
     */
    public function supports($data)
    {
        return $data instanceof Reservation;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $parameters)
    {
        return $this->entityManager->getRepository(Reservation::class)
            ->findOneBy($parameters);
    }
}