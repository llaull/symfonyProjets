<?php

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Domotique\ReseauBundle\Entity\Log;
use Domotique\ReseauBundle\Entity\Module;

class InputController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function addJsonAction(Request $request)
    {

        $content = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('logger');

        $getDomoboxKey = $this->get('app.options')->getOptionValue("domobox.x.api.key");

        // stop si la clée n'est pas bonne
        if($getDomoboxKey != $request->headers->get("X-DOMOBOXAPIKEY")){
            $logger->alert("SPY -> ".$content);
            return new JsonResponse(array('requete' => "fail"));
        }

        //si le contenu n'est pas vide on decode la string json en tableau php
        if (!empty($content)) {
            $params = json_decode($content, true);
        }

        $moduleX = $em->getRepository('DomotiqueReseauBundle:Module')->findOneBy(array('adressMac' => $params['mac']));

        /*
         * si pas de module trouvé
         */
        if (!$moduleX) {
            $logger->error("Unable to find module entity. new module created");

            $module = new Module();
            $module->setId(NULL);
            $module->setName("nouveau module");
            $module->setAdressMac($params['mac']);
            $module->setAdressIpv4($params['ipv4']);

            $em->persist($module);
            $em->flush();

            /*
             * si module touvé on creé un nouveau log
             */
        } else {

            /*
             * mets a jour l'ip du module
             */
            if ($moduleX->getAdressIpv4() != $params['ipv4']) {

                $moduleX->setAdressIpv4($params['ipv4']);
                $em->persist($moduleX);

            }

            // creation d'un log par donnée de sonde
            foreach ($params['sensors'] as $k => $v) {

                //va chercher l'objet par l'id
                $sensorType = $em->getRepository('DomotiqueReseauBundle:SensorType')->find($params['sensors'][$k]["sensor type Id"]);
                $sensorUnit = $em->getRepository('DomotiqueReseauBundle:SensorUnit')->find($params['sensors'][$k]["sensor unit Id"]);

                $log = new Log();

                $log->setModule($moduleX);
                $log->setSensorId($params['sensors'][$k]['sensor Id']);
                $log->setSensorType($sensorType);
                $log->setSensorUnit($sensorUnit);

                if (is_numeric($params['sensors'][$k]['sensor value'])) {
                    $log->setSonsorValue($params['sensors'][$k]['sensor value']);
                } else {
                    $log->setSonsorValue(0);
                    $log->setSonsorValueString($params['sensors'][$k]['sensor value']);
                }


                $em->persist($log);
            }

            //
            $em->flush();
        }

        return new JsonResponse(array('requete' => "sucess"));
    }
}
