<?php

namespace App\Form\Handler;

use App\Manager\DataManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ReservationFormHandler implements FormHandlerInterface
{
    /**
     * @var DataManagerInterface
     */
    private $dataManager;

    /**
     * ReservationTyeHandler constructor.
     * @param DataManagerInterface $dataManager
     */
    public function __construct(DataManagerInterface $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    public function handleRequest(FormInterface $form, Request $request)
    {
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->dataManager->persist($form->getData());

            return true;
        }

        return false;
    }
}