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

    public function indexAction()
    {
        $form = new ApplicationForm('Filtro');
        $param = array();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->bind($data);
            $form->setData($data);
            
            $situacao = $form->get('situacao')->getValue();
            if($situacao != '') {
                $param['situacao'] = $situacao;
            }
            
        }
        
        $atividades = $this->getAtividadeTable()->findAll($param);
  
        return new ViewModel(array('form'=>$form, 'atividades'=>$atividades));
    }
}
