<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 04/10/2016
 * Time: 15:15
 */

namespace AppBundle\BackBundle\Services;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class MaintenanceService
{
    private $container;
    private $pathEnable;
    private $em;
    private $options;

    /**
     * MaintenanceService constructor.
     * @param ContainerInterface $containerInterface
     * @param EntityManager $entityManager
     * @param AppOptionsService $appOptionsService
     */
    public function __construct(ContainerInterface $containerInterface, EntityManager $entityManager, AppOptionsService $appOptionsService)
    {
        $this->container = $containerInterface;
        $this->em = $entityManager;
        $this->options = $appOptionsService;
    }


    public function onKernelRequest(GetResponseEvent $event)
    {
        $maintenance = $this->options->getOptionName("app.maintenance.mode")->getValue();

        $debug = in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev'));

        $request = $event->getRequest();

//        if ($maintenance && !$this->isPermitUrl($request) && !$debug) {
//            $engine = $this->container->get('templating');
//            $content = $engine->render('@FrondOffice/Default/maintenance.html.twig');
//            $event->setResponse(new Response($content, 503));
//            $event->stopPropagation();
//        }

    }

    private function isPermitUrl($request)
    {
        $this->pathEnable[] = '/js/';
        $this->pathEnable[] = '/assets/global/plugins/bootstrap-switch/css/';
        $this->pathEnable[] = '/assets/';
        $this->pathEnable[] = '/amcharts/';
        $this->pathEnable[] = '/images/';
        $this->pathEnable[] = '/css/';
        $this->pathEnable[] = '/bundles/';
        $this->pathEnable[] = '/_wdt/';
        $this->pathEnable[] = '/_profiler/';

        $this->pathEnable[] = '/admin/';
        $this->pathEnable[] = '/login';

        foreach ($this->pathEnable as $path)
            if (preg_match('{' . $path . '}', $request->getPathInfo()))
                return true;
        return false;
    }
}
