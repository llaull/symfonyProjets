<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 13/10/2016
 * Time: 11:20
 */

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SnowboyController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function meteoByEmplacemeentAction(Request $request)
    {
        // variables
        $key = $request->headers->get("domobox-key");
        $emplacement = $request->attributes->get('emplacement');
        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('logger');

        $logger->error($key);

        // recherche l'emplacement et recuperer son id
        try {
            $getEmplacement = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Emplacement')->findOneBy(array("name" => $emplacement));
        } catch (\Doctrine\ORM\EntityNotFoundException $e) {
            $logger->critical($e->getMessage());
            return new JsonResponse(array("data" => "impossible de trouver des modules dans l'emplacement !"));
        }

        if (!$getEmplacement) {
            return new JsonResponse(array("data" => "impossible de trouver l'emplacement demander !"));
        }

        //aller chercher les informations du modules
        $getLog = $this->getDoctrine()->getRepository('DomotiqueReseauBundle:Log');
        $results = $getLog->getValueByEmplacement($em, $getEmplacement->getId());

        //construire la phrase de retour
        $reponse = "dans " . $emplacement . " il fait ";

        foreach ($results as $k => &$value) {
            if ($value["unitee_symbole"] == "%") $hum = " d'humidité"; else $hum = "";
            $reponse .= intval($value["sonsor_value"]) . ' ' . $value["unitee_symbole"] . $hum . " avec ";
        }

        $reponse = rtrim($reponse, " avec ");

        return new JsonResponse(array("data" => $reponse));
    }

}
