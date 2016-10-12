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
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class MaintenanceService
{
    private $container;
    private $pathEnable;
    private $em;
    private $options;
    private $t;

    /**
     * MaintenanceService constructor.
     * @param ContainerInterface $containerInterface
     * @param EntityManager $entityManager
     * @param AppOptionsService $appOptionsService
     */
    public function __construct(ContainerInterface $containerInterface, EntityManager $entityManager, AppOptionsService $appOptionsService, TokenStorageInterface $token)
    {
        $this->container = $containerInterface;
        $this->em = $entityManager;
        $this->options = $appOptionsService;
        $this->t = $token;
    }


    public function onKernelRequest(GetResponseEvent $event)
    {
        // check is maintenance mode is ON
        $maintenance = $this->options->getOptionName("app.maintenance.mode")->getValue();

        // check si on est en environement dev/test
        $debug = in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev'));

        // check si admin session
//        $securityContext = $this->container->get('security.authorization_checker');
//        $isAdmin = $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED');
//        if (!$this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
//            throw $this->createAccessDeniedException();
//        }


//        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
//        }


        // check les gets
        $request = $event->getRequest();

//        if(!$sd && !$this->isPermitUrl($request)) {
//echo  $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN');
//        if ($debug) {
            if ($maintenance && !$this->isPermitUrl($request) && !$debug) {
//            if ($maintenance && !$this->isPermitUrl($request) && !$debug && !$isAdmin) {
                $engine = $this->container->get('templating');
                $content = $engine->render('@FrondOffice/Default/maintenance.html.twig');
                $event->setResponse(new Response($content, 503));
                $event->stopPropagation();
            }
//        }

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

        $this->pathEnable[] = '/profile/';
        $this->pathEnable[] = '/admin/';
        $this->pathEnable[] = '/login';
        $this->pathEnable[] = '/logout';

        foreach ($this->pathEnable as $path)
            if (preg_match('{' . $path . '}', $request->getPathInfo()))
                return true;
        return false;
    }
}
