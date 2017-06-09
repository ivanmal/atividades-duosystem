<?php

namespace Application\Model;

/**
 *
 * @author ivanx
 */
interface AtividadeInterface
{
    /**
     * @return int id
     */
    public function getId();
    
    /**
     * @return string nome
     */
    public function getNome();
    
    /**
     * @return string descrição
     */
    public function getDescricao();
    
    /**
     * @return date date inicial
     */
    public function getDataInicio();
    
    /**
     * @return date data final
     */
    public function getDataFim();
    
    /**
     * @return int id do status
     */
    public function getStatus();
    
    /**
     * @return bool flag de situação
     */
    public function getSituacao();
    
    /**
     * @return string situação
     */
    public function getLabelSituacao();
}
