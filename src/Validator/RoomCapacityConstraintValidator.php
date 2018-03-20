<?php

namespace App\Validator;

use App\Entity\Reservation;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RoomCapacityConstraintValidator
{
    /**
     * Checks whether or not the object is valid
     *
     * @param $object
     * @param ExecutionContextInterface $context
     * @param $payload
     */
    const ERROR_MESSAGE = 'The room {{ roomId }} can only accept {{ roomCapacity }} people.';

    /**
     * Checks whether or not the object is valid
     *
     * @param $object
     * @param ExecutionContextInterface $context
     * @param $payload
     */
    public function validate($object, ExecutionContextInterface $context, $payload)
    {
        if (!$object instanceof Reservation) {
            return;
        }

        if ($object->getRoom()->getCapacity() <= $object->getPersonsCount()) {
            $context
                ->addViolation(self::ERROR_MESSAGE, ['{{ roomId }}' => $object->getRoom()->getId(), '{{ roomCapacity }}' => $object->getRoom()->getCapacity() ])
            ;
        }
    }
}