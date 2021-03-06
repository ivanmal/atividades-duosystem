<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Application\Model\Atividade;
use Application\Model\AtividadeTable;
use Application\Model\Status;
use Application\Model\StatusTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\AtividadeTable' => function($sm) {
                    $tableGateway = $sm->get('AtividadeTableGateway');
                    $table = new AtividadeTable($tableGateway);
                    return $table;
                },
                'AtividadeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Atividade());
                    return new TableGateway('atividade', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\StatusTable' => function($sm) {
                    $tableGateway = $sm->get('StatusTableGateway');
                    $table = new StatusTable($tableGateway);
                    return $table;
                },
                'StatusTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Status());
                    return new TableGateway('status', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
