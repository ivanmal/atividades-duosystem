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
use Application\Form\AtividadeForm;
use Application\Form\Filter\AtividadeFilter;
use Application\Model\AtividadeTableInterface;
use Application\Model\StatusTableInterface;
use Exception;
use Zend\I18n\Translator\Resources;
use Zend\I18n\Translator\Translator;
use Zend\I18n\Translator\TranslatorInterface;
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
     *
     * @var TranslatorInterface
     */
    private $translator;

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

    /**
     * 
     * @return TranslatorInterface
     */
    public function getTranslator()
    {
        if (!$this->translator) {
            $this->translator = new Translator();

            $this->translator->addTranslationFilePattern(
                'phpArray', Resources::getBasePath(), Resources::getPatternForValidator()
            );
        }

        return $this->translator;
    }

    /**
     * Index
     * @return ViewModel
     */
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

        return new ViewModel(array('form' => $form, 'atividades' => $atividades, 'statusTable' => $this->getStatusTable()));
    }

    /**
     * Adicionar Atividade
     * @return ViewModel
     */
    public function addAction()
    {
        $form = new AtividadeForm('addForm', $this->getServiceLocator()->get('Application\Model\StatusTable'));
        $form->setInputFilter(new AtividadeFilter());
        $form->get('submit')->setValue('Adicionar');

        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $atividade = new \Application\Model\Atividade();

                $atividade->exchangeArray($form->getData());

                try {
                    $this->getAtividadeTable()->save($atividade);

                    $this->flashMessenger()->addSuccessMessage(array('success' => 'Atividade criada com sucesso.'));
                    return $this->redirect()->toRoute('home');
                } catch (Exception $e) {
                    echo $this->flashMessenger()->addErrorMessage(array($e->getMessage()));
                }
            } else {
                $this->flashMessenger()->addErrorMessage(array('error' => 'Verifique o(s) campo(s)'));
            }
        }

        return new ViewModel(array('form' => $form, 'translator' => $this->getTranslator()));
    }

    public function editAction()
    {

        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('home');
        }

        try {
            $atividade = $this->getAtividadeTable()->findAtividade($id);
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage(array('error' => 'Atividade näo encontrada.'));
            return $this->redirect()->toRoute('home');
        }

        if ($atividade->getStatus() == \Application\Model\Constantes::STATUS_CONCLUIDO) {
            $this->flashMessenger()->addErrorMessage(array('error' => 'Não é possível alterar atividades concluídas.'));
            return $this->redirect()->toRoute('home');
        }

        if (!$atividade->getSituacao()) {
            $this->flashMessenger()->addErrorMessage(array('error' => 'Não é possível alterar atividades inativas.'));
            return $this->redirect()->toRoute('home');
        }

        $form = new AtividadeForm('editForm', $this->getStatusTable());
        $form->bind($atividade);
        $form->setInputFilter(new AtividadeFilter());
        $form->get('submit')->setValue('Editar');

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                try {
                    $this->getAtividadeTable()->save($atividade);

                    $this->flashMessenger()->addSuccessMessage(array('success' => 'Atividade alterada com sucesso.'));
                    return $this->redirect()->toRoute('home');
                } catch (Exception $e) {
                    echo $this->flashMessenger()->addErrorMessage(array($e->getMessage()));
                }
            } else {
                $this->flashMessenger()->addErrorMessage(array('error' => 'Verifique o(s) campo(s)'));
            }
        }

        return new ViewModel(array('id' => $id, 'form' => $form, 'translator' => $this->getTranslator(),));
    }

    public function changeSituacaoAction()
    {

        $id = $this->params()->fromRoute('id', 0);

        if ($id) {
            try {
                $atividade = $this->getAtividadeTable()->changeSituacao($id);

                $this->flashMessenger()->addSuccessMessage(array('success' => 'Situação da atividade alterada.'));
            } catch (Exception $e) {
                $this->flashMessenger()->addErrorMessage(array('error' => $e->getMessage()));
            }
        }

        return $this->redirect()->toRoute('home');
    }
}
