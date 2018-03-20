<?php

namespace App\Manager;

interface DataManagerInterface
{
    /**
     * Persists the given data into the data layer
     *
     * @param $data
     *
     * @return mixed
     */
    public function persist($data);

    /**
     * Checks if the given data is supported by *this* class
     *
     * @param $data
     *
     * @return mixed
     */
    public function supports($data);

    /**
     * Returns an object that matches the parameters
     *
     * @param array $parameters
     *
     * @return mixed
     */
    public function findOneBy(array $parameters);
}