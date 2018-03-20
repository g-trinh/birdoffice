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

    /**
     * {@inheritdoc}
     */
    public function persist($data)
    {
        if ($this->supports($data)) {
            $this->entityManager->persist($data);
            // I don't like flushing right after persisting, but for this example's sake, i will do it to win some time.
            // It would be better to call flush() method independently as it is RAM/processor/network and time consuming.
            $this->entityManager->flush();
        }
    }
}