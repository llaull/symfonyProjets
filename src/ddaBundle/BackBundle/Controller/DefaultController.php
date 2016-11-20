<?php

namespace ddaBundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $artistes = $em->getRepository('ddaBundleArtisteBundle:Artiste');
        $artistesNb = $artistes->getActiveCount();

        return $this->render('ddaBundleBackBundle:Default:index.html.twig', array(
            'artistes' => $artistesNb,
        ));

    }
}
