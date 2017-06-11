<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Classe da tabela Atividade
 *
 * @author ivanx
 */
class AtividadeTable implements AtividadeTableInterface
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll($param = array())
    {
        $resultSet = $this->tableGateway->select($param);
        return $resultSet;
    }

    public function findAtividade($id)
    {
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar a atividade");
        }
        return $row;
    }

    public function save(AtividadeInterface $atividade)
    {
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $atividade->getDataInicio());
        $dataInicio = $dataInicio->format('Y-m-d');

        if (!empty($atividade->getDataFim())) {
            $dataFim = \DateTime::createFromFormat('d/m/Y', $atividade->getDataFim());
            $dataFim = $dataFim->format('Y-m-d');
        } else {
            $dataFim = $atividade->getDataFim();
        }

        $data = array(
            'nome' => $atividade->getNome(),
            'descricao' => $atividade->getDescricao(),
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim,
            'status' => $atividade->getStatus(),
            'situacao' => $atividade->getSituacao(),
        );

        $id = $atividade->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
        }
        else {
            if ($this->findAtividade($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Atividade não encontrada');
            }
        }
    }

    public function changeSituacao($id)
    {
        $data = array();

        $atividade = $this->findAtividade($id);

        if ($atividade) {

            if ($atividade->getStatus() == Constantes::STATUS_CONCLUIDO) {
                throw new \Exception('Não é possível alterar atividades concluídas.');
            }

            if ($atividade->getSituacao() == 0) {
                $data['situacao'] = 1;
            } else {
                $data['situacao'] = 0;
            }

            $this->tableGateway->update($data, array('id' => $id));
        } else {
            throw new \Exception('Atividade não encontrada');
        }
    }
}
