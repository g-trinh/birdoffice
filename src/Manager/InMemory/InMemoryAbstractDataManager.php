<?php

namespace App\Manager\InMemory;

use App\Manager\DataManagerInterface;

abstract class InMemoryAbstractDataManager implements DataManagerInterface
{
    /**
     * Array containing data
     *
     * @var array
     */
    protected $data;

    /**
     * {@inheritdoc}
     */
    public function persist($data)
    {
        $this->data[] = $data;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function supports($data);
}