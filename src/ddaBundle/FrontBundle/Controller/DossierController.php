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

        //dossier selectionner
        $dossiers = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findOneBy(
            array("artiste" => $artiste, "slug" => $dossier),
            array("ordre" => 'ASC')
        );

        //liste les dossiers enfant
        $dossiersEnfant = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findBy(
            array('category' => $dossiers),
            array("ordre" => 'ASC')
        );

        return $this->render('@ddaBundleFront/dossier/show.html.twig', array(
            'artiste' => $artiste,
            'dossiers' => $dossiers,
            'dossiersEnfant' => $dossiersEnfant,
        ));
    }

    /*
     * affiche les dossiers du'un artiste
     */
    public function showDossierEnfantAction($artiste, $parent, $dossier)
    {

        $em = $this->getDoctrine()->getManager();

        $artiste = $em->getRepository('ddaBundleArtisteBundle:Artiste')->findOneBy(array("slug" => $artiste));

        //dossier parent
        $dossierParent = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findOneBy(
            array("artiste" => $artiste, "slug" => $parent)

        );


        //dossier selectionner
        $dossiers = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findOneBy(
            array("artiste" => $artiste, 'category' => $dossierParent, "slug" => $dossier)
        );

//        die(var_dump($dossiers));

        //liste les dossiers enfant
//        $dossiersEnfant = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findBy(
//            array('category' => $dossiers),
//            array("ordre" => 'ASC')
//        );

        return $this->render('@ddaBundleFront/dossier/show.html.twig', array(
            'artiste' => $artiste,
            'dossiers' => $dossiers,
            'dossiersEnfant' => null
        ));
    }
}