<?php

namespace ddaBundle\ArtisteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ddaBundleArtisteBundle:Default:index.html.twig');
    }
}
