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

        $data = current($params);
//        var_dump($data);
//
        $moduleX = $em->getRepository('DomotiqueReseauBundle:Module')->findOneBy(array('adressMac' => $data['mac']));



        if (!$moduleX) {
            $logger->error("Unable to find module entity. module");
//
            $module = new Module();
            $module->setId(NULL);
            $module->setAdressMac($data['mac']);
            $module->setAdressIpv4($data['ipv4']);
//
            $em->persist($module);
            $em->flush();
            var_dump("new module");
            } else {
            var_dump($moduleX->getName());

                foreach ($data['sensors'] as $k => $v) {
                    $log = new Log();

                    $sensorType = $em->getRepository('DomotiqueReseauBundle:SensorType')->find($data['sensors'][$k]['sensor type Id']);
                    $sensorUnit = $em->getRepository('DomotiqueReseauBundle:SensorUnit')->find($data['sensors'][$k]['sensor unit Id']);
                    $log->setModule($moduleX);
                    $log->setSensorId($data['sensors'][$k]['sensor Id']);
                    $log->setSensorType($sensorType);
                    $log->setSensorUnit($sensorUnit);
                    $log->setSonsorValue($data['sensors'][$k]['sensor value']);
                    $em->persist($log);
                }
                $em->flush();
        }

        return new JsonResponse(array('requete' => "sucess"));
    }
}
