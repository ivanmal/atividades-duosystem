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
        
    }

    public function save(AtividadeInterface $atividade)
    {
        
    }

    public function changeSituacao($id)
    {
        
    }
}
