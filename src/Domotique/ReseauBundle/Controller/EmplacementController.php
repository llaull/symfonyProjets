<?php

namespace Domotique\ReseauBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\ReseauBundle\Entity\Emplacement;

/**
 * Emplacement controller.
 *
 */
class EmplacementController extends Controller
{
    /**
     * Lists all Emplacement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emplacements = $em->getRepository('DomotiqueReseauBundle:Emplacement')->findAll();

        return $this->render('@DomotiqueReseau/emplacement/index.html.twig', array(
            'entities' => $emplacements,
        ));
    }

    /**
     * Creates a new Emplacement entity.
     *
     */
    public function newAction(Request $request)
    {
        $emplacement = new Emplacement();
        $form = $this->createForm('Domotique\ReseauBundle\Form\Type\EmplacementType', $emplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emplacement);
            $em->flush();

            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Entity added");

            return $this->redirectToRoute('admin_domotique_emplacement_index');
        }

        return $this->render('@DomotiqueReseau/emplacement/new.html.twig', array(
            'emplacement' => $emplacement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Emplacement entity.
     *
     */
    public function showAction(Emplacement $emplacement)
    {
        $deleteForm = $this->createDeleteForm($emplacement);

        return $this->render('@DomotiqueReseau/emplacement/show.html.twig', array(
            'emplacement' => $emplacement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Emplacement entity.
     *
     */
    public function editAction(Request $request, Emplacement $emplacement)
    {
        $deleteForm = $this->createDeleteForm($emplacement);
        $editForm = $this->createForm('Domotique\ReseauBundle\Form\Type\EmplacementType', $emplacement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emplacement);
            $em->flush();

            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Entity updated");
            return $this->redirectToRoute('admin_domotique_emplacement_index');
        }

        return $this->render('@DomotiqueReseau/emplacement/edit.html.twig', array(
            'emplacement' => $emplacement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Emplacement entity.
     *
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:Emplacement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Texte entity.');
        }

        try {
            $em->remove($entity);
            $em->flush();
            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Suppression réalisé avec succèss");
        } catch (\PDOException $e) {
            $this->get('ras_flash_alert.alert_reporter')->addError("Suppression impossible : des articles utilise cette categorie");
        }


        return $this->redirect($this->generateUrl('admin_domotique_emplacement_index'));

    }

    /**
     * Creates a form to delete a Emplacement entity.
     *
     * @param Emplacement $emplacement The Emplacement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Emplacement $emplacement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domotique_emplacement_delete', array('id' => $emplacement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
