<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * This is a dummy constraint validator.
 * It would normally check in database, or whatsoever
 *
 * Class RoomExistsContraintValidator
 * @package App\Validator
 */
class DateNotPassedConstraintValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        $now = new \DateTime();

        if ($value instanceof \DateTime && $value <= $now) {
            $this->context
                ->addViolation($constraint->message, ['{{ date }}' => $value->format('d/m/Y H:i:s') ])
            ;
        }
    }
}