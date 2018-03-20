<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Form\Handler\FormHandlerInterface;
use App\Form\ReservationType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ReservationController extends Controller
{
    private $requestStack;
    private $normalizer;
    private $serializer;
    private $validator;
    private $handler;

    /**
     * ReservationController constructor.
     * @param RequestStack $requestStack
     * @param DenormalizerInterface $normalizer
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param FormHandlerInterface $handler
     */
    public function __construct(
        RequestStack $requestStack,
        DenormalizerInterface $normalizer,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        FormHandlerInterface $handler
    )
    {
        $this->requestStack = $requestStack;
        $this->normalizer = $normalizer;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->handler = $handler;
    }

    /**
     * @Route("/reservation/serializer", name="post_reservation_serializer", methods={"post"})
     */
    public function postWithSerializer()
    {
        $request = $this->requestStack->getMasterRequest();

        try {
            $reservation = $this->normalizer->denormalize($request->request->all(), Reservation::class);
        } catch(UnexpectedValueException $valueException) {
            die('i');
            throw new BadRequestHttpException("Bad request.");
        }
die;
        $violationList = $this->validator->validate($reservation);
        if (count($violationList) > 0) {
            return $violationList;
        }
dump($reservation);die;
        // We can imagine a listener that would check if the returned data is not a response
        // and that would serialize the response automatically thanks to handlers
        return new JsonResponse($this->serializer->serialize($reservation, 'json'));
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

        $errors = [];
        foreach($form->getErrors(true) as $error) {
            // Should use a PropertyPathResolverInterface to retrieve the real property name
            $errors[$error->getCause()->getPropertyPath()] = $error->getMessage();
        }

        return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
    }
}
