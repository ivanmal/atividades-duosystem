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
        
    }

    public function changeSituacao($id)
    {
        $data = array();

        $atividade = $this->findAtividade($id);

        if ($atividade) {

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
