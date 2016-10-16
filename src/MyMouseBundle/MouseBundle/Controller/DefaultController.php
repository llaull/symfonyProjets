<?php

namespace MyMouseBundle\MouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyMouseBundleMouseBundle:Default:index.html.twig');
    }
}
