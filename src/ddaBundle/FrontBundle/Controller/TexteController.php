<?php

namespace ddaBundle\FrontBundle\Controller;

use ddaBundle\ArtisteBundle\Entity\Texte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Texte controller.
 *
 */
class TexteController extends Controller
{

    public function getVideo()
    {
        $em = $this->getDoctrine()->getManager();

        $textes = $em->getRepository('ddaBundleArtisteBundle:Texte')->findAll();

        return $textes;
    }

    public function accueilAction()
    {
        $textes = $this->getVideo();

        return $this->render('@ddaBundleFront/texte/accueil.html.twig', array(
            'textes' => $textes,
        ));
    }



}
