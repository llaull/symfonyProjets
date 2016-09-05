<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 06/05/2016
 * Time: 10:38
 */

namespace AppBundle\BackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\BackBundle\Entity\User;

class UserController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('BackOfficeBundle:User')->findAll();

        return $this->render('BackOfficeBundle:User:index.html.twig', array(
            'users' => $user,
        ));
    }

    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\BackBundle\Form\Type\UserRegistrationFormType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            try {
                $em->flush();
                $this->get('ras_flash_alert.alert_reporter')->addSuccess("réalisé avec succèss");
            } catch (\PDOException $e) {
                $this->get('ras_flash_alert.alert_reporter')->addError("erreur" . $e);
            }

            return $this->redirectToRoute('back_office_user_index');
        }

        return $this->render('BackOfficeBundle:User:new.html.twig', array(
            'emplacement' => $user,
            'form' => $form->createView(),
        ));

    }

    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\BackBundle\Form\Type\UserEditFormType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            try {
                $em->flush();
                $this->get('ras_flash_alert.alert_reporter')->addSuccess("réalisé avec succèss");
            } catch (\PDOException $e) {
                $this->get('ras_flash_alert.alert_reporter')->addError("impossible" . $e);
            }


            return $this->redirectToRoute('back_office_user_index', array('id' => $user->getId()));
        }

        return $this->render('BackOfficeBundle:User:edit.html.twig', array(
            'emplacement' => $user,
            'edit_form' => $editForm->createView()
        ));
    }
}
