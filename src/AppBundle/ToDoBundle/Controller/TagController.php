<?php

namespace AppBundle\ToDoBundle\Controller;

use AppBundle\ToDoBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TagController extends Controller
{

    /*
     * ajout d'un tag en ajax
     * returne un flux json
     */
    public function addAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('AppBundle\ToDoBundle\Form\Type\TagType', $tag);
        $form->handleRequest($request);

        $logger = $this->get('logger');

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {

            $em->persist($tag);

            try {
                $em->flush();
                return new JsonResponse(array('query' => 'sucess'));
            } catch (\Exception $e) {
                $logger->critical($e->getMessage());
                return new JsonResponse(array('query' => $e->getMessage()));
            }

        }

    }
}
