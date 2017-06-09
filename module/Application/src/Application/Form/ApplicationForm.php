<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;

class ApplicationForm extends Form
{

    public function __construct($name)
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
                    'class' => 'col-2 col-form-label',
                ),
                'value_options' => array(
                    '' => 'Todos',
                    '1' => 'Ativo',
                    '0' => 'Inativo',
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'loginCsrf',
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
