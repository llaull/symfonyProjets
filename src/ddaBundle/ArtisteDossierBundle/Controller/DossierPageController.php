<?php

namespace ddaBundle\ArtisteDossierBundle\Controller;

use ddaBundle\ArtisteDossierBundle\Entity\DossierPage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dossierpage controller.
 *
 */
class DossierPageController extends Controller
{
    /**
     * Lists all dossierPage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dossierPages = $em->getRepository('ArtisteDossierBundle:DossierPage')->findAll();

        return $this->render('dossierpage/index.html.twig', array(
            'dossierPages' => $dossierPages,
        ));
    }

    /**
     * Creates a new dossierPage entity.
     *
     */
    public function newAction(Request $request)
    {
        $dossierPage = new Dossierpage();
        $form = $this->createForm('ddaBundle\ArtisteDossierBundle\Form\DossierPageType', $dossierPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dossierPage);
            $em->flush($dossierPage);

            return $this->redirectToRoute('admin_artiste_dossier_page_show', array('id' => $dossierPage->getId()));
        }

        return $this->render('dossierpage/new.html.twig', array(
            'dossierPage' => $dossierPage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dossierPage entity.
     *
     */
    public function showAction(DossierPage $dossierPage)
    {
        $deleteForm = $this->createDeleteForm($dossierPage);

        return $this->render('dossierpage/show.html.twig', array(
            'dossierPage' => $dossierPage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dossierPage entity.
     *
     */
    public function editAction(Request $request, DossierPage $dossierPage)
    {
        $deleteForm = $this->createDeleteForm($dossierPage);
        $editForm = $this->createForm('ddaBundle\ArtisteDossierBundle\Form\DossierPageType', $dossierPage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_artiste_dossier_page_edit', array('id' => $dossierPage->getId()));
        }

        return $this->render('dossierpage/edit.html.twig', array(
            'dossierPage' => $dossierPage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dossierPage entity.
     *
     */
    public function deleteAction(Request $request, DossierPage $dossierPage)
    {
        $form = $this->createDeleteForm($dossierPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dossierPage);
            $em->flush($dossierPage);
        }

        return $this->redirectToRoute('admin_artiste_dossier_page_index');
    }

    /**
     * Creates a form to delete a dossierPage entity.
     *
     * @param DossierPage $dossierPage The dossierPage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DossierPage $dossierPage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_artiste_dossier_page_delete', array('id' => $dossierPage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
