<?php

namespace AppBundle\ToDoBundle\Controller;

use AppBundle\ToDoBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('AppBundle\ToDoBundle\Form\Type\TagType', $tag);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

       /* if ($request->getMethod() == 'POST') {


            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('app_bundle_to_do_homepage',array(
                'tags' => $tag,
                'formTag' => $form->createView(),
            ));
        }*/

        // $em = $this->getDoctrine()->getManager();

        $tag = $em->getRepository('AppBundleToDoBundle:Tag')->findAll();


        return $this->render('AppBundleToDoBundle:Default:index.html.twig',array(
            'tags' => $tag,
            'formTag' => $form->createView(),
        ));
    }

}
