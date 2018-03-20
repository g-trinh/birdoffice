<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateNotPassedConstraint extends Constraint
{
    public $message = "The {{ date }} is already passed.";
}