<?php
namespace Application\Model;

/**
 *
 * @author ivanx
 */
interface StatusTableInterface
{

    /**
     * Retorna todas os status
     * @param array $param
     */
    public function findAll($param);

    /**
     * Retorna um Status de acordo com o id
     * @param int $id
     * @return StatusInterface
     */
    public function findStatus($id);
}
