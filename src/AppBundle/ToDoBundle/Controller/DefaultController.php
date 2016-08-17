<?php

namespace AppBundle\ToDoBundle\Controller;

use AppBundle\ToDoBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function w()
    {
        return $this->render('AppBundleToDoBundle:Default:index.html.twig');
    }

    public function indexAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm('AppBundle\ToDoBundle\Form\Type\TaskType', $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('app_bundle_to_do_homepage');
        }

        return $this->render('AppBundleToDoBundle:Default:index.html.twig', array(
            'task' => $task,
            'form' => $form->createView(),
        ));
    }
}
