<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * StatusTable
 *
 * @author ivanx
 */
class StatusTable implements StatusTableInterface
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll($param = array())
    {
        $result = array();

        $resultSet = $this->tableGateway->select();


        if (isset($param['type']) && $param['type'] == 'array') {
            $result[''] = 'Todos';
            foreach ($resultSet as $row) {
                $result[$row->getId()] = $row->getNome();
            }
        } else {
            $result = $resultSet;
        }

        return $result;
    }

    public function findStatus($id)
    {
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar o status");
        }
        return $row;
    }
}
