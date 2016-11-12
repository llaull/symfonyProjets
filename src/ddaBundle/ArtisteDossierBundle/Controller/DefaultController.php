<?php

namespace ddaBundle\ArtisteDossierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArtisteDossierBundle:Default:index.html.twig');
    }
}
