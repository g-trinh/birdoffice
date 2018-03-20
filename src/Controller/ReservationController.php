<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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

    /**
     * ReservationController constructor.
     * @param RequestStack $requestStack
     * @param DenormalizerInterface $normalizer
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        RequestStack $requestStack,
        DenormalizerInterface $normalizer,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    )
    {
        $this->requestStack = $requestStack;
        $this->normalizer = $normalizer;
        $this->serializer = $serializer;
        $this->validator = $validator;
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
            throw new BadRequestHttpException("Bad request.");
        }

        $violationList = $this->validator->validate($reservation);
        if (count($violationList) > 0) {
            return $violationList;
        }

        return new JsonResponse($this->serializer->serialize($reservation, 'json'));
    }
}
