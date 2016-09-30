<?php

namespace AppBundle\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\BackBundle\Entity\Options;


/**
 * Options controller.
 *
 */
class OptionsController extends Controller
{
     /**
     * Lists all Options entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $options = $em->getRepository('BackOfficeBundle:Options')->findAll();

        return $this->render('@BackOffice/options/index.html.twig', array(
            'options' => $options,
        ));
    }

    /**
     * Creates a new Options entity.
     *
     */
    public function newAction(Request $request)
    {
        $option = new Options();
        $form = $this->createForm('AppBundle\BackBundle\Form\Type\OptionsType', $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $option->setUser($this->getUser());
            $em->persist($option);
            $em->flush();

            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Entity added");
            return $this->redirectToRoute('app_options_index');
        }

        return $this->render('@BackOffice/options/new.html.twig', array(
            'option' => $option,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Options entity.
     *
     */
    public function showAction(Options $option)
    {
        $deleteForm = $this->createDeleteForm($option);

        return $this->render('@BackOffice/options/show.html.twig', array(
            'option' => $option,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Options entity.
     *
     */
    public function editAction(Request $request, Options $option)
    {
        $deleteForm = $this->createDeleteForm($option);
        $editForm = $this->createForm('AppBundle\BackBundle\Form\Type\OptionsType', $option);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($option);
            $em->flush();

            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Entity modified");
            return $this->redirectToRoute('app_options_index');
        }

        return $this->render('@BackOffice/options/edit.html.twig', array(
            'option' => $option,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Options entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BackOfficeBundle:Options')->find($id);
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
        return $this->redirect($this->generateUrl('app_options_index'));
    }


    /**
     * Creates a form to delete a Options entity.
     *
     * @param Options $option The Options entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Options $option)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_options_delete', array('id' => $option->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
