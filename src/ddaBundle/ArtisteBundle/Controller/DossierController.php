<?php

namespace ddaBundle\ArtisteBundle\Controller;

use ddaBundle\ArtisteBundle\Entity\Dossier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Dossier controller.
 *
 */
class DossierController extends Controller
{


    /**
     * Lists all artiste entities.
     *
     */
    public function gererAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $artiste = $em->getRepository('ddaBundleArtisteBundle:Artiste')->findOneBy(array("id" => $id));

        $categories = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findBy(array("artiste" => $artiste));

        return $this->render('@ddaBundleArtiste/dossier/gerer.html.twig', array(
            'artiste' => $artiste,
            'categories' => $categories,
        ));
    }

    public function orderAction(Request $request)
    {
        $data = $request->request->get('data');
        $params = json_decode($data, true);
        $em = $this->getDoctrine()->getManager();


        function run_array_parent($array, $parent)
        {
            $post_db = array();
            foreach ($array as $head => $body) {
                if (isset($body['children'])) {
                    $head++;
                    $post_db[$body['id']] = ['parent' => $parent, 'order' => $head, 'id' => $body['id']];
                    $post_db = $post_db + run_array_parent($body['children'], $body['id']);
                } else {
                    $head++;
                    $post_db[$body['id']] = ['parent' => $parent, 'order' => $head, 'id' => $body['id']];
                }
            }

            return $post_db;
        }

        $post_db = run_array_parent($params, '0');

//        die(var_dump($post_db));
        foreach ($post_db as $v) {
            $categories = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findOneBy(array("id" => $v["id"]));

            if (!$categories) {
                throw $this->createNotFoundException('Unable to find Dossier entity.');
            }

            $categoriesParent = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findOneBy(array("id" => $v["parent"]));

//            if (!$categoriesParent) {
//                throw $this->createNotFoundException('Unable to find Dossier parent entity.');
//            }

            $categories->setCategory($categoriesParent);
            $categories->setOrdre($v["order"]);

        }
        $em->flush();

        return new JsonResponse(array('result' => "ok"));
    }

    /**
     * Lists all dossier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dossiers = $em->getRepository('ddaBundleArtisteBundle:Dossier')->findAll();

        return $this->render('@ddaBundleArtiste/dossier/index.html.twig', array(
            'dossiers' => $dossiers,
        ));
    }

    /**
     * Creates a new dossier entity.
     *
     */
    public function newAction(Request $request)
    {
        $dossier = new Dossier();
        $form = $this->createForm('ddaBundle\ArtisteBundle\Form\Type\DossierType', $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $dossier->setCreator($this->getUser());
            $dossier->setNormalise(true);
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute('admin_artiste_dossier_index');
        }

        return $this->render('@ddaBundleArtiste/dossier/new.html.twig', array(
            'dossier' => $dossier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dossier entity.
     *
     */
    public function showAction(Dossier $dossier)
    {
        $deleteForm = $this->createDeleteForm($dossier);

        return $this->render('@ddaBundleArtiste/dossier/show.html.twig', array(
            'dossier' => $dossier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing dossier entity.
     *
     */
    public function editAction(Request $request, Dossier $dossier)
    {
        $deleteForm = $this->createDeleteForm($dossier);
        $editForm = $this->createForm('ddaBundle\ArtisteBundle\Form\Type\DossierType', $dossier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $dossier->setCreator($this->getUser());
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute('admin_artiste_dossier_index');
        }

        return $this->render('@ddaBundleArtiste/dossier/edit.html.twig', array(
            'dossier' => $dossier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dossier entity.
     *
     */
    public function deleteAction(Request $request, Dossier $dossier)
    {
        $form = $this->createDeleteForm($dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dossier);
            $em->flush($dossier);
        }

        return $this->redirectToRoute('admin_artiste_dossier_index');
    }

    /**
     * Creates a form to delete a dossier entity.
     *
     * @param Dossier $dossier The dossier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dossier $dossier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_artiste_dossier_delete', array('id' => $dossier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
