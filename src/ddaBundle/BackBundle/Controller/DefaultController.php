<?php

namespace ddaBundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ddaBundleBackBundle:Default:index.html.twig');
    }
}
