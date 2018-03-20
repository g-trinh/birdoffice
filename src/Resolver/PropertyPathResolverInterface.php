<?php

namespace App\Resolver;

interface PropertyPathResolverInterface
{
    /**
     * Resolves the property path from a given string, and for a given object
     *
     * @param $propertyPath
     * @param $object
     *
     * @return mixed
     */
    public function resolve($propertyPath, $object);
}