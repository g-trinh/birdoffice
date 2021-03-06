<?php

namespace App\Validator;

use App\Entity\Room;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * This is a dummy constraint validator.
 * It would normally check in database, or whatsoever
 *
 * Class RoomExistsContraintValidator
 * @package App\Validator
 */
class RoomExistsConstraintValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        // If $value is not an instance of Room, it is a numeric.
        if (!$value instanceof Room && ($value < 200 || $value > 299)) {
            $this->context
                ->addViolation($constraint->message, ['{{ roomNumber }}' => $value ])
            ;
        }
    }
}