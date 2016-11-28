<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 27/11/2016
 * Time: 17:27
 */

namespace ddaBundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArtisteController extends Controller
{

    /**
     * affiche tous les artiste
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artistes = $em->getRepository('ddaBundleArtisteBundle:Artiste');
        $artistesWithCategory = $artistes->getArtisteWithCatgeory();

        return $this->render('@ddaBundleFront/Artiste/index.html.twig', array(
            'artistes' => $artistesWithCategory,
        ));
    }

    /*
    * affiche un artiste
    */
    public function showAction($slug)
    {

        $em = $this->getDoctrine()->getManager();

        $artiste = $em->getRepository('ddaBundleArtisteBundle:Artiste')->findOneBy(array("slug" => $slug));

        $dossiers = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findBy(
            array("artiste" => $artiste, "category" => null),
            array("ordre" => 'ASC')
        );

        return $this->render('@ddaBundleFront/dossier/index.html.twig', array(
            'artiste' => $artiste,
            'dossiers' => $dossiers,
        ));
    }
}
