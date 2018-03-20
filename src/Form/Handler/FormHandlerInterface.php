<?php

namespace App\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

interface FormHandlerInterface
{
    /**
     * Method that will submit the request if neccessary, and then process it
     *
     * @param FormInterface $form
     * @param Request $request
     *
     * @return bool
     */
    public function handleRequest(FormInterface $form, Request $request);
}