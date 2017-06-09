<?php
namespace Application\Model;

/**
 *
 * @author ivanx
 */
interface AtividadeTableInterface
{

    /**
     * Retorna todas as atividades
     * @param array $param
     */
    public function findAll($param);

    /**
     * Retorna uma Atividade de acordo com o id
     * @param int $id
     */
    public function findAtividade($id);

    /**
     * Salva Atividade na base
     * @param \Application\Model\AtividadeInterface $atividade
     */
    public function save(AtividadeInterface $atividade);
    
    /**
     * Ativa/Inativa Atividade
     * @param int $id
     */
    public function changeSituacao($id);
}
