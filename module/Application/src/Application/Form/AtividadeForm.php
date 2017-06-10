<?php
namespace Application\Form;

use Application\Model\StatusTableInterface;
use Zend\Form\Form;

class AtividadeForm extends Form
{

    public function __construct($name, StatusTableInterface $status)
    {

        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Nome',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'descricao',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Descrição',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'data_inicio',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Data Início',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'data_fim',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control',
                'required' => false,
            ),
            'options' => array(
                'label' => 'Data Fim',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'status',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'status',
                'class' => 'form-control',
                'required' => true,
                'value' => '',
            ),
            'options' => array(
                'label' => 'Status',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
                'value_options' => $status->findAll(array('type' => 'array', 'select' => 'Selecione')),
            ),
        ));

        $this->add(array(
            'name' => 'situacao',
            'required' => true,
            'filters' => array(
                array('name' => 'Boolean'),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3600
                )
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Salvar',
                'class' => 'btn btn-primary',
            ),
        ));
    }
}
