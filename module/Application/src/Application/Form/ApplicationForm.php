<?php
namespace Application\Form;

use Application\Model\StatusTableInterface;
use Zend\Form\Form;

class ApplicationForm extends Form
{
    public function __construct($name, StatusTableInterface $status)
    {

        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-inline');

        $this->add(array(
            'name' => 'situacao',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control',
                'required' => false,
            ),
            'options' => array(
                'label' => 'Situação',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
                'value_options' => array(
                    '' => 'Todos',
                    '1' => 'Ativo',
                    '0' => 'Inativo',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'status',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control',
                'required' => false,
                'value' => '',
            ),
            'options' => array(
                'label' => 'Status',
                'label_attributes' => array(
                    'class' => 'form-control-label',
                ),
                'value_options' => $status->findAll(array('type' => 'array')),
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
                'class' => 'btn btn-primary',
                'type' => 'submit',
                'value' => 'Filtrar',
            ),
        ));
    }
}
