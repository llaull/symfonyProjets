<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 09/02/2016
 * Time: 16:32
 */

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class OutputController extends Controller
{


    public function logAmChartTotalAction()
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $results = $entities->geTotal($em);

        return new JsonResponse($results);
    }

    /**
     * retourne en JSON TOUTES de les sondes par heure
     * @param $unit
     * @return JsonResponse
     */
    public function logAmChartsAction($unit)
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $results = $entities->getMoyenneValue($em, $unit);

        return new JsonResponse($results);
    }

    public function logMoyenneAction($unit, $spot)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $entities = $entities->getMoyenHourGroupByModule($em, $unit, $spot);

        return new JsonResponse($entities);
    }

    /**
     * donne la date et heure courrante
     * @return JsonResponse
     */
    public function getCurrentDateAction()
    {
        $now = new \DateTime();
        $currentDate = $now->format('d-m-Y');
        $currentHour = $now->format('G:i:s');
        $currentTime = $now->getTimestamp();

        $return = array("date" => $currentDate, "hour" => $currentHour, "timestamp" => $currentTime);
        return new JsonResponse($return);
    }

    /**
     *
     * donne les values des modules dans l'heure
     * @return JsonResponse
     */
    public function getCurrentValueJsonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $entities = $entities->getCurrentValue($em);

        return new JsonResponse($entities);
    }

    /*
     *
     */
    public function getDomoboxNotifyAction()
    {
        $em = $this->getDoctrine()->getManager();

        $moduleNotifies = $em->getRepository('DomotiqueReseauBundle:ModuleNotify')->findBy(array(), array('created' => 'DESC'));

        return $this->render('DomotiqueDomoboxBundle:ui_notification:index.html.twig', array(
            'entities' => $moduleNotifies,
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function getWebcamAction(Request $request)
    {

        $securityContext = $this->container->get('security.authorization_checker');
        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('logger');
        $curling = $this->container->get('commun.curl');
        $imageParDefaut = "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";


        // si utilisateur authentifier on va rechercher
        // images de webcam avec file_get_contents
        // sinon
        // on renvoie une image par defaut $imageParDefaut
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $data = $request->request->get('data');
            $params = current(json_decode($data, true));
            $image = "webcam.png?" . rand() . "";

            // try pour récuper les ip des modules webcam
            try {
                $moduleNotifies = $em->getRepository('DomotiqueReseauBundle:Module')->find($params['module']);
            } catch (\Doctrine\ORM\EntityNotFoundException $e) {
                $logger->critical($e->getMessage());
            }

            // construction du lien reseau de la webcam
            $webcamUrl = "http://" . $moduleNotifies->getAdressIpv4() . ":8080/?action=snapshot";

            // si le code en reponse lien est 200
            // alors on renvoie l'image télécharger
            if ($curling->getHttpResponseCode($webcamUrl) == "200") {

                $file = base64_encode(file_get_contents($webcamUrl));

                $headers = array(
                    'Content-Type' => 'image/jpg',
                    'Pragma-directive' => 'no-cache',
                    'Cache-directive' => 'no-cache',
                    'Cache-control' => 'no-cache',
                    'Pragma:' => 'no-cache',
                    'Expires:' => 0,
                    'Content-Disposition' => 'inline; filename="' . $image . '"');

                return new Response($file, 200, $headers);

            } else {
                return new JsonResponse(array('error' => $curling->getHttpResponseCode($webcamUrl), "image" => $imageParDefaut));
            }


        } else {

            return new JsonResponse(array("error" => "anonymous", "image" => $imageParDefaut));

        }

    }

}
