<?php

namespace App\Tests;

use App\Entity\Room;
use App\Event\Listener\ObjectResponseListener;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ObjectResponseListenerTest extends WebTestCase
{
    public function test_onKernelView_shouldSucceed()
    {
        $serializer = $this->getMockBuilder(SerializerInterface::class)->getMock();
        $listener = new ObjectResponseListener($serializer);

        $kernel = $this->getMockBuilder(HttpKernelInterface::class)->getMock();
        $request = $this->getMockBuilder(Request::class)->getMock();

        $event = new GetResponseForControllerResultEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, ['super' => 'man']);
        $listener->onKernelView($event);

        $this->assertNull($event->getResponse());

        $object = new Room();
        $object->setNumber(250);

        $event = new GetResponseForControllerResultEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, $object);
        $listener->onKernelView($event);

        $this->assertInstanceOf(JsonResponse::class, $event->getResponse());
    }
}