<?php

namespace Domotique\ReseauBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Domotique\ReseauBundle\Entity\SensorUnit;

/**
 * SensorUnit controller.
 *
 */
class SensorUnitController extends Controller
{
    /**
     * Lists all SensorUnit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sensorUnits = $em->getRepository('DomotiqueReseauBundle:SensorUnit')->findAll();

        return $this->render('@DomotiqueReseau/sensorunit/index.html.twig', array(
            'entities' => $sensorUnits,
        ));
    }

    /**
     * Creates a new SensorUnit entity.
     *
     */
    public function newAction(Request $request)
    {
        $sensorUnit = new SensorUnit();
        $form = $this->createForm('Domotique\ReseauBundle\Form\Type\SensorUnitType', $sensorUnit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sensorUnit);
            $em->flush();

            return $this->redirectToRoute('admin_domotique_sensor_unit_index');
        }

        return $this->render('@DomotiqueReseau/sensorunit/new.html.twig', array(
            'sensorUnit' => $sensorUnit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SensorUnit entity.
     *
     */
    public function showAction(SensorUnit $sensorUnit)
    {
        $deleteForm = $this->createDeleteForm($sensorUnit);

        return $this->render('@DomotiqueReseau/sensorunit/show.html.twig', array(
            'sensorUnit' => $sensorUnit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SensorUnit entity.
     *
     */
    public function editAction(Request $request, SensorUnit $sensorUnit)
    {
        $deleteForm = $this->createDeleteForm($sensorUnit);
        $editForm = $this->createForm('Domotique\ReseauBundle\Form\Type\SensorUnitType', $sensorUnit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sensorUnit);
            $em->flush();

            $this->get('ras_flash_alert.alert_reporter')->addSuccess("Entity updated");
            return $this->redirectToRoute('admin_domotique_sensor_unit_index');
        }

        return $this->render('@DomotiqueReseau/sensorunit/edit.html.twig', array(
            'sensorUnit' => $sensorUnit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SensorUnit entity.
     *
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DomotiqueReseauBundle:SensorUnit')->find($id);

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


        return $this->redirect($this->generateUrl('admin_domotique_sensor_unit_index'));

    }

    /**
     * Creates a form to delete a SensorUnit entity.
     *
     * @param SensorUnit $sensorUnit The SensorUnit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SensorUnit $sensorUnit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domotique_sensor_unit_delete', array('id' => $sensorUnit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
