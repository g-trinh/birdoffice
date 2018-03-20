<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RoomExistsConstraint extends Constraint
{
    public $message = "The room number {{ roomNumber }} does not exist";
}