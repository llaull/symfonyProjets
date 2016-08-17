<?php

namespace AppBundle\FrondBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('FrondOfficeBundle:Default:metronic.html.twig');
    }
}
