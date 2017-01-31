<?php

namespace Domotique\ProgrammeTvBundle\Controller;

use Domotique\ProgrammeTvBundle\Entity\Channel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Channel controller.
 *
 */
class ChannelController extends Controller
{
    /**
     * Lists all channel entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $channels = $em->getRepository('ProgrammeTvBundle:Channel')->findAll();

        return $this->render('ProgrammeTvBundle:channel:index.html.twig', array(
            'channels' => $channels,
        ));
    }

    /**
     * Creates a new channel entity.
     *
     */
    public function newAction(Request $request)
    {
        $channel = new Channel();
        $form = $this->createForm('Domotique\ProgrammeTvBundle\Form\ChannelType', $channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($channel);
            $em->flush($channel);

            return $this->redirectToRoute('admin_channel_show', array('id' => $channel->getId()));
        }

        return $this->render('ProgrammeTvBundle:channel:new.html.twig', array(
            'channel' => $channel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a channel entity.
     *
     */
    public function showAction(Channel $channel)
    {
        $deleteForm = $this->createDeleteForm($channel);

        return $this->render('channel/show.html.twig', array(
            'channel' => $channel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing channel entity.
     *
     */
    public function editAction(Request $request, Channel $channel)
    {
        $deleteForm = $this->createDeleteForm($channel);
        $editForm = $this->createForm('Domotique\ProgrammeTvBundle\Form\ChannelType', $channel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_channel_edit', array('id' => $channel->getId()));
        }

        return $this->render('ProgrammeTvBundle:channel:edit.html.twig', array(
            'channel' => $channel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a channel entity.
     *
     */
    public function deleteAction(Request $request, Channel $channel)
    {
        $form = $this->createDeleteForm($channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($channel);
            $em->flush($channel);
        }

        return $this->redirectToRoute('admin_channel_index');
    }

    /**
     * Creates a form to delete a channel entity.
     *
     * @param Channel $channel The channel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Channel $channel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_channel_delete', array('id' => $channel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
