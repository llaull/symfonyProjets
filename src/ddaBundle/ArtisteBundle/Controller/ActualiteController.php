<?php

namespace ddaBundle\ArtisteBundle\Controller;

use ddaBundle\ArtisteBundle\Entity\Actualite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Actualite controller.
 *
 */
class ActualiteController extends Controller
{
    /**
     * Lists all actualite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('ddaBundleArtisteBundle:Actualite')->findAll();

        return $this->render('@ddaBundleArtiste/actualite/index.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    /**
     * Creates a new actualite entity.
     *
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualite();
        $form = $this->createForm('ddaBundle\ArtisteBundle\Form\Type\ActualiteType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $actualite->setCreator($this->getUser());
            $actualite->setSlug($actualite->getArtiste()->getSlug() . '-' . $actualite->getTitre());
            $em->persist($actualite);
            $em->flush($actualite);

            return $this->redirectToRoute('admin_actualitee_index');
        }

        return $this->render('@ddaBundleArtiste/actualite/new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a actualite entity.
     *
     */
    public function showAction(Actualite $actualite)
    {

        return $this->render('@ddaBundleArtiste/actualite/show.html.twig', array(
            'actualite' => $actualite,
        ));
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     */
    public function editAction(Request $request, Actualite $actualite)
    {
        $editForm = $this->createForm('ddaBundle\ArtisteBundle\Form\Type\ActualiteType', $actualite);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $actualite->setCreator($this->getUser());
            $actualite->setSlug($actualite->getArtiste()->getSlug() . '-' . $actualite->getTitre());
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('admin_actualitee_index');
        }

        return $this->render('@ddaBundleArtiste/actualite/edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     */

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ddaBundleArtisteBundle:Actualite')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actualite entity.');
        }
        try {
            $em->remove($entity);
            $em->flush();
            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Suppression réalisé avec succèss");
        } catch (\PDOException $e) {
            $this->get('ras_flash_alert.alert_reporter')->addError("Suppression impossible : des articles utilise cette categorie");
        }
        return $this->redirect($this->generateUrl('admin_actualitee_index'));
    }


}
