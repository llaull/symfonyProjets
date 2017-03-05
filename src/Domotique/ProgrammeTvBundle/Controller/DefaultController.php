<?php

namespace Domotique\ProgrammeTvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProgrammeTvBundle:Programme:index.html.twig');
    }
}
