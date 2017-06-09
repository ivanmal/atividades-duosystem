<?php
namespace Application\Model;

/**
 *
 * @author ivanx
 */
interface StatusInterface
{
    /**
     * @return int id
     */
    public function getId();

    /**
     * @return string nome
     */
    public function getNome();
}
