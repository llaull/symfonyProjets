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

    public function meteoByEmplacemeentAction($emplacement)
    {
//        recherche l'emplacement et recuperer son id
//
//aller chercher les informations du modules
//
//construire la phrase de retour


        //reponse temporaire
        return new JsonResponse(array("data"=>$emplacement));
    }

}