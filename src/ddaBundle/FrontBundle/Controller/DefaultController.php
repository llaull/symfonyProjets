<?php

namespace ddaBundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ddaBundle\FrontBundle\Entity\Page;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ddaBundleFrontBundle:Default:accueil.html.twig');
    }

    /**
     * Finds and displays a page entity.
     *
     */
    public function allPageAction(Page $page)
    {
        return $this->render('@ddaBundleFront/page/show.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * affiche les videos active en front
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allVideoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('ddaBundleArtisteBundle:Video')->findBy(array("active" => true), array("id" => "ASC"));

        return $this->render('@ddaBundleFront/video/index.html.twig', array(
            'videos' => $videos,
        ));
    }

    public function allArtisteAction()
    {
        $em = $this->getDoctrine()->getManager();


        $artistes = $em->getRepository('ddaBundleArtisteBundle:Artiste');
        $artistesWithCategory = $artistes->getArtisteWithCatgeory();

        return $this->render('@ddaBundleFront/Artiste/index.html.twig', array(
            'artistes' => $artistesWithCategory,
        ));
    }
}
