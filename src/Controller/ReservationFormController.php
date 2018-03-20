<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\Handler\FormHandlerInterface;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;

class ReservationFormController extends Controller
{
    private $requestStack;
    private $serializer;
    private $handler;

    /**
     * ReservationController constructor.
     * @param RequestStack $requestStack
     * @param SerializerInterface $serializer
     * @param FormHandlerInterface $handler
     */
    public function __construct(
        RequestStack $requestStack,
        SerializerInterface $serializer,
        FormHandlerInterface $handler
    )
    {
        $this->requestStack = $requestStack;
        $this->serializer = $serializer;
        $this->handler = $handler;
    }

    /**
     * @Route("/reservation/form", name="post_reservation_form", methods={"post"})
     */
    public function postWithForm()
    {
        $request = $this->requestStack->getMasterRequest();
        $form = $this->createForm(ReservationType::class, new Reservation());

        if ($this->handler->handleRequest($form, $request)) {
            return $form->getData();
        }

        return $form->getErrors(true);
    }
}
