<?php
namespace Application\Model;

/**
 * Model Atividade
 *
 * @author ivanx
 */
class Atividade implements AtividadeInterface
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $nome;

    /**
     *
     * @var string
     */
    private $descricao;

    /**
     *
     * @var string
     */
    private $dataInicio;

    /**
     *
     * @var string
     */
    private $dataFim;

    /**
     * Id do Status
     * @var int
     */
    private $status;

    /**
     *
     * @var int
     */
    private $situacao;

    /**
     * 
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nome = (!empty($data['nome'])) ? $data['nome'] : null;
        $this->descricao = (!empty($data['descricao'])) ? $data['descricao'] : null;
        $this->dataInicio = (!empty($data['data_inicio'])) ? $data['data_inicio'] : null;
        $this->dataFim = (!empty($data['data_fim'])) ? $data['data_fim'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : null;
        $this->situacao = (!empty($data['situacao'])) ? $data['situacao'] : null;
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
            'descricao' => $this->descricao,
            'data_inicio' => $this->dataInicio,
            'data_fim' => $this->dataFim,
            'status' => $this->status,
            'situacao' => $this->situacao,
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    public function getDataFim()
    {
        return $this->dataFim;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSituacao()
    {
        return $this->situacao;
    }

    public function getLabelSituacao()
    {
        if ($this->situacao) {
            return 'Ativo';
        }

        return 'Inativo';
    }
}
