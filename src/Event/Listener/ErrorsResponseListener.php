<?php

namespace App\Event\Listener;

use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ErrorsResponseListener
{
    private $serializer;

    /**
     * ViolationListResponseListener constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        if ($result instanceof ConstraintViolationListInterface || $result instanceof FormErrorIterator) {
            $event->setResponse(new JsonResponse($this->serializer->serialize($result, 'json'), Response::HTTP_BAD_REQUEST));
        }
    }
}