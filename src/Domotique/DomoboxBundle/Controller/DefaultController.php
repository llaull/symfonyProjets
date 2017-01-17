<?php

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $emplacements = $em->getRepository('DomotiqueReseauBundle:Emplacement')->findBy(array(), array('name' => 'ASC'));

        //
        $em = $this->getDoctrine()->getManager();
        $modules = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $modules = $modules->getCurrentValue($em);

        return $this->render('DomotiqueDomoboxBundle:Default:accueil.html.twig', array(
            'emplacements' => $emplacements,
            'modules' => $modules,
        ));

    }


    public function setModuleColorAction(Request $request)
    {

        $data = $request->request->get('data');
        $curling = $this->container->get('commun.curl');

        $params = json_decode($data, true);


        $em = $this->getDoctrine()->getManager();
        $module = $em->getRepository('DomotiqueReseauBundle:Module')->find($params[0]['module']);

        $module_url = "http://".$module->getAdressIpv4()."/RGB?rgb=".$params[2]['color'];

        $curl = $curling->getToUrl($module_url, false);
        $reponse = array('curl' => $curl, 'set' => $module_url);

        return new JsonResponse($reponse);


    }

}
