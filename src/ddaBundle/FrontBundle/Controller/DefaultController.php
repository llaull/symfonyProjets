<?php

namespace ddaBundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function allPageAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $pages = $em->getRepository('ddaBundleFrontBundle:Page')->findBy(array('slug' => $slug));

        return $this->render('@ddaBundleFront/page/show.html.twig', array(
            'page' => $pages
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





}
