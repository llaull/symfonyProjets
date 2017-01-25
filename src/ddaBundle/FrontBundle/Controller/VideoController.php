<?php

namespace ddaBundle\FrontBundle\Controller;

use ddaBundle\ArtisteBundle\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Video controller.
 *
 */
class VideoController extends Controller
{

    public function getVideo()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('ddaBundleArtisteBundle:Video')->findAll();

        return $videos;
    }

    public function accueilAction()
    {
        $videos = $this->getVideo();

        return $this->render('@ddaBundleFront/actualiteDda/accueil.html.twig', array(
            'videos' => $videos,
        ));
    }
}
