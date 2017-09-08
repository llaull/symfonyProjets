<?php

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Process\Process;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Symfony\Component\Process\Exception\ProcessFailedException;

use Symfony\Component\HttpFoundation\JsonResponse;

class ChatQueryController extends Controller
{
    public function indexAction()
    {



        return new JsonResponse(array('requete' => true));

    }
}
