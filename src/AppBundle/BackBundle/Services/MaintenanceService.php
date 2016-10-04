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

class MaintenanceService
{
    private $container;
    private $pathEnable;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $maintenance = $this->container->hasParameter('maintenance') ? $this->container->getParameter('maintenance') : false;

        $debug = in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev'));

        $router = $this->container->get('router')->getContext()->getPathInfo();
        $adminPath = preg_match("/admin/", $router);
//        $route = $router->getRouteCollection()->get();

        $request = $event->getRequest();


        if ($maintenance && !$adminPath && !$this->isPermitUrl($request)) {
//        if ($maintenance && !$debug) {
            $engine = $this->container->get('templating');
            $content = $engine->render('@FrondOffice/Default/maintenance.html.twig');
            $event->setResponse(new Response($content, 503));
            $event->stopPropagation();
        }

    }

    private function isPermitUrl($request)
    {
        $this->pathEnable[] = '/js/';
        $this->pathEnable[] = '/assets/';
        $this->pathEnable[] = '/images/';
        $this->pathEnable[] = '/css/';
        $this->pathEnable[] = '/bundles/';
        $this->pathEnable[] = '/_wdt/';
        $this->pathEnable[] = '/_profiler/';

        foreach ($this->pathEnable as $path)
            if (preg_match('{' . $path . '}', $request->getPathInfo()))
                return true;
        return false;
    }
}