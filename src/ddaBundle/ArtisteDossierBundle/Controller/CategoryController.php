<?php

namespace ddaBundle\ArtisteDossierBundle\Controller;

use ddaBundle\ArtisteDossierBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{

    /**
     * @param Request $request
     */
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

        foreach ($post_db as $v) {
            $categories = $em->getRepository('ArtisteDossierBundle:Category')->findOneBy(array("id" => $v["id"]));

            if (!$categories) {
                throw $this->createNotFoundException('Unable to find Lieu entity.');
            }

            $categoriesParent = $em->getRepository('ArtisteDossierBundle:Category')->findOneBy(array("id" => $v["parent"]));

            if (!$categoriesParent) {
                throw $this->createNotFoundException('Unable to find Lieu entity.');
            }

            $categories->setCategory($categoriesParent);
            $categories->setOrdre($v["order"]);

        }
        $em->flush();

        return new JsonResponse(array('result' => "ok"));
    }

    /**
     * Lists all category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ArtisteDossierBundle:Category')->findAll();

        return $this->render('@ArtisteDossier/category/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function getCategoryCount()
    {
        $em = $this->getDoctrine()->getManager();

        //$categories = $em->getRepository('ArtisteDossierBundle:Category')->();
    }

    /**
     * Creates a new category entity.
     *
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('ddaBundle\ArtisteDossierBundle\Form\Type\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $category->setCreator($this->getUser());
            $em->persist($category);
            $em->flush($category);

            return $this->redirectToRoute('admin_artiste_dossier_categorie_index');
        }

        return $this->render('@ArtisteDossier/category/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     */
    public function showAction(Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('@ArtisteDossier/category/show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('ddaBundle\ArtisteDossierBundle\Form\Type\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_artiste_dossier_categorie_index');
        }

        return $this->render('@ArtisteDossier/category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush($category);
        }

        return $this->redirectToRoute('admin_artiste_dossier_categorie_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_artiste_dossier_categorie_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
