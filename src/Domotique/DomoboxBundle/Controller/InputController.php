<?php

namespace Domotique\DomoboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Domotique\ReseauBundle\Entity\Log;

class InputController extends Controller
{


    /**
     * @return JsonResponse
     * $sensorFluxAdd = new \DateTime(rand(-12, 12).' hour');
     */
    public function addFuxFakeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sensorFluxAdd = new \DateTime();

        $logger = $this->get('logger');

        $moduleId = 1;
        $sensorId = 1;
        $sensorTypeId = 8;
        $sensorUnitId = 7;
        $sensorValue = 1;

        $log = new Log();

        $moduleX = $em->getRepository('DomotiqueReseauBundle:Module')->find($moduleId);
        $sensorType = $em->getRepository('DomotiqueReseauBundle:SensorType')->find($sensorTypeId);
        $sensorUnit = $em->getRepository('DomotiqueReseauBundle:SensorUnit')->find($sensorUnitId);

        try {
            $log->setModule($moduleX);
            $log->setSensorId($sensorId);
            $log->setSensorType($sensorType);
            $log->setSensorUnit($sensorUnit);
            $log->setSonsorValue($sensorValue);
            $log->setCreated($sensorFluxAdd);
            $em->persist($log);
            $em->flush();
        } catch (\Doctrine\ORM\EntityNotFoundException $e) {
            $logger->critical($e->getMessage());
            return new JsonResponse(array('requete' => $e->getMessage()));
        }

        return new JsonResponse(array('requete' => "sucess"));
    }
    /**
     * @return JsonResponse
     */
    public function addJsonAction(Request $request)
    {

        $content = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('logger');

        if (!empty($content)) {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        var_dump($params);

        $moduleX = $em->getRepository('DomotiqueReseauBundle:Module')->findOneBy(array('adressMac' => $params['mac']));

        //die(var_dump($moduleX->getName()));

        return new JsonResponse(array('requete' => "sucess"));

        return new JsonResponse(array('requete' => "sucess"));
    }
}
