<?php

namespace App\Event\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;

class ObjectResponseListener
{
    private $serializer;

    /**
     * ErrorsResponseListener constructor.
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

        if (is_object($result)) {
            // We could create an Annotation that would give us groups that will filter the response
            $event->setResponse(new JsonResponse($this->serializer->serialize($result, 'json')));
        }
    }
}