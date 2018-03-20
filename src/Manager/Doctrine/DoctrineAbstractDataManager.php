<?php

namespace App\Manager\Doctrine;

use App\Manager\DataManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

abstract class DoctrineAbstractDataManager implements DataManagerInterface
{
    protected $entityManager;

    /**
     * DoctrineAbstractManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function persist($data)
    {
        if ($this->supports($data)) {
            $this->entityManager->persist($data);
        }
    }

    abstract public function supports($data);
}