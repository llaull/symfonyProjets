<?php

namespace ddaBundle\ArtisteBundle\Controller;

use ddaBundle\ArtisteBundle\Entity\Artiste;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Artiste controller.
 *
 */
class ArtisteController extends Controller
{
    /**
     * Lists all artiste entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $artistes = $em->getRepository('ddaBundleArtisteBundle:Artiste')->findAll();

        return $this->render('@ddaBundleArtiste/artiste/index.html.twig', array(
            'artistes' => $artistes,
        ));
    }

    /**
     * Creates a new artiste entity.
     *
     */
    public function newAction(Request $request)
    {
        $artiste = new Artiste();
        $form = $this->createForm('ddaBundle\ArtisteBundle\Form\Type\ArtisteType', $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artiste);
            $em->flush($artiste);

            return $this->redirectToRoute('admin_artiste_index');
        }

        return $this->render('@ddaBundleArtiste/artiste/new.html.twig', array(
            'artiste' => $artiste,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a artiste entity.
     *
     */
    public function showAction(Artiste $artiste)
    {
        $deleteForm = $this->createDeleteForm($artiste);

        return $this->render('@ddaBundleArtiste/artiste/show.html.twig', array(
            'artiste' => $artiste,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing artiste entity.
     *
     */
    public function editAction(Request $request, Artiste $artiste)
    {
        $deleteForm = $this->createDeleteForm($artiste);
        $editForm = $this->createForm('ddaBundle\ArtisteBundle\Form\Type\ArtisteType', $artiste);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_artiste_edit', array('id' => $artiste->getId()));
        }

        return $this->render('@ddaBundleArtiste/artiste/edit.html.twig', array(
            'artiste' => $artiste,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a artiste entity.
     *
     */
    public function deleteAction(Request $request, Artiste $artiste)
    {
        $form = $this->createDeleteForm($artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($artiste);
            $em->flush($artiste);
        }

        return $this->redirectToRoute('admin_artiste_index');
    }

    /**
     * Creates a form to delete a artiste entity.
     *
     * @param Artiste $artiste The artiste entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Artiste $artiste)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_artiste_delete', array('id' => $artiste->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
