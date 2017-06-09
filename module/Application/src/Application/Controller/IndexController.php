<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Application\Form\ApplicationForm;
use Application\Model\AtividadeTableInterface;
use Application\Model\StatusTableInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    /**
     *
     * @var AtividadeTableInterface
     */
    private $atividadeTable;

    /**
     *
     * @var StatusTableInterface
     */
    private $statusTable;

    /**
     * Recupera instância de AtividadeTable
     * @return AtividadeTableInterface
     */
    public function getAtividadeTable()
    {
        if (!$this->atividadeTable) {
            $sm = $this->getServiceLocator();
            $this->atividadeTable = $sm->get('Application\Model\AtividadeTable');
        }
        return $this->atividadeTable;
    }

    /**
     * Recupera instância de StatusTable
     * @return StatusTableInterface
     */
    public function getStatusTable()
    {
        if (!$this->statusTable) {
            $sm = $this->getServiceLocator();
            $this->statusTable = $sm->get('Application\Model\StatusTable');
        }
        return $this->statusTable;
    }

    public function indexAction()
    {
        $form = new ApplicationForm('Filtro', $this->getServiceLocator()->get('Application\Model\StatusTable'));
        $param = array();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->bind($data);
            $form->setData($data);

            $situacao = $form->get('situacao')->getValue();
            $status = $form->get('status')->getValue();

            if ($situacao != '') {
                $param['situacao'] = $situacao;
            }

            if ($status != '') {
                $param['status'] = $status;
            }
        }
        $atividades = $this->getAtividadeTable()->findAll($param);

        return new ViewModel(array('form' => $form, 'atividades' => $atividades, 'statusTable'=> $this->getStatusTable()));
    }
}
