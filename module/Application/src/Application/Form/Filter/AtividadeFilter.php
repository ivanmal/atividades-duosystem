<?php
namespace Application\Form\Filter;

use Application\Model\Constantes;
use DateTime;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Callback;
use Zend\Validator\Date;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * Classe de filtros do form de atividade
 */
class AtividadeFilter extends InputFilter
{

    public function __construct()
    {

        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                new StringLength(array('max' => 255, 'encoding' => 'UTF-8')),
            ),
        ));

        $this->add(array(
            'name' => 'descricao',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                new StringLength(array('max' => 600, 'encoding' => 'UTF-8')),
            ),
        ));

        $this->add(array(
            'name' => 'data_inicio',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'date',
                    'options' => array(
                        'format' => 'd/m/Y',
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'data_fim',
            'required' => true,
            'allow_empty' => true,
            'continue_if_empty' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'Callback',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            Callback::INVALID_VALUE => 'O campo é obrigatório para Atividades Concluídas.',
                        ),
                        'callback' => function($value, $context = array()) {

                            $noEmpty = new NotEmpty(array('string', 'null'));

                            if (!$noEmpty->isValid($value)) {
                                if ($context['status'] == Constantes::STATUS_CONCLUIDO) {
                                    return false;
                                }
                            }

                            return true;
                        },
                    ),
                ),
                array(
                    'name' => 'Callback',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            Callback::INVALID_VALUE => 'O valor de entrada não parece ser uma data válida.',
                        ),
                        'callback' => function($value, $context = array()) {

                            $noEmpty = new NotEmpty(array('string', 'null'));

                            if ($noEmpty->isValid($value)) {
                                $dateValidator = new Date(array('format' => 'd/m/Y'));
                                if (!$dateValidator->isValid($value)) {
                                    return false;
                                }
                            }

                            return true;
                        },
                    ),
                ),
                array(
                    'name' => 'Callback',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            Callback::INVALID_VALUE => 'O valor de entrada deve ser maior que a data de Início.',
                        ),
                        'callback' => function($value, $context = array()) {

                            $noEmpty = new NotEmpty(array('string', 'null'));

                            if ($noEmpty->isValid($value)) {
                                $dataFim = DateTime::createFromFormat('d/m/Y', $value);
                                $dataInicio = DateTime::createFromFormat('d/m/Y', $context['data_inicio']);

                                $interval = $dataFim->diff($dataInicio);

                                if ($interval->format('%R%a') > 0) {
                                    return false;
                                }
                            }

                            return true;
                        },
                    ),
                ),
            ),
        ));
    }
}
