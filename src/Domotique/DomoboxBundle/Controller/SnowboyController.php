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

    public function meteoByEmplacemeentAction(Request $request)
    {
//        recherche l'emplacement et recuperer son id
//
//aller chercher les informations du modules
//
//construire la phrase de retour
//
        $key = $request->headers->get("domobox-key");
        $emplacement = $request->attributes->get('emplacement');

        $reponse = "la key est " . $key . " et l emplacement demander est " . $emplacement;


        //reponse temporaire
        return new JsonResponse(array("data" => $reponse));
    }

}