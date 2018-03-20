<?php

namespace App\Validator;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class StartAndEndDateRangeConstraintValidator
{
    /**
     * Checks whether or not the object is valid
     *
     * @param $object
     * @param ExecutionContextInterface $context
     * @param $payload
     */
    public function validate($object, ExecutionContextInterface $context, $payload)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        if (!is_array($object)) {
            $startDate = $propertyAccessor->getValue($object, 'startDate');
            $endDate = $propertyAccessor->getValue($object, 'endDate');
        } else {
            $startDate = $propertyAccessor->getValue($object, '[startDate]');
            $endDate = $propertyAccessor->getValue($object, '[endDate]');
        }

        if ($startDate > $endDate) {
            $context->buildViolation('End date must be higher than start date.')
                ->atPath('endDate')
                ->addViolation();
        }
    }
}