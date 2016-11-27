<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 25/11/2016
 * Time: 21:01
 */

namespace ddaBundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DossierController extends Controller
{

    /*
     * affiche les dossiers du'un artiste
     */
    public function showDossierAction($artiste, $dossier)
    {

        $em = $this->getDoctrine()->getManager();

        $artiste = $em->getRepository('ddaBundleArtisteBundle:Artiste')->findOneBy(array("slug" => $artiste));

        $dossiers = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findBy(
                                                            array("artiste" => $artiste, 'slug' => $dossier),
                                                            array("ordre" => 'ASC')
                                                            );

        return $this->render('@ddaBundleFront/dossier/show.html.twig', array(
            'artiste' => $artiste,
            'dossiers' => $dossiers,
        ));
    }
}