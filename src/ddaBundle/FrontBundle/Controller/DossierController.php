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

    public function showDossierAction($slug)
    {

        $em = $this->getDoctrine()->getManager();

        $artiste = $em->getRepository('ddaBundleArtisteBundle:Artiste')->findOneBy(array("slug" => $slug));

        $dossiers = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findBy(array("artiste" => $artiste));


        return $this->render('@ddaBundleFront/dossier/index.html.twig', array(
            'artiste' => $artiste,
            'dossiers' => $dossiers,
        ));
    }
}