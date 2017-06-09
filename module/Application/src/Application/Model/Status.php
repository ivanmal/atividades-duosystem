<?php
namespace Application\Model;

/**
 * Model de Status
 *
 * @author ivanx
 */
class Status implements StatusInterface
{

    /**
     *
     * @var int id
     */
    private $id;

    /**
     *
     * @var string nome
     */
    private $nome;

    /**
     * 
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
    }

    /**
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
        );
    }

    /**
     * 
     * @return id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }
}
