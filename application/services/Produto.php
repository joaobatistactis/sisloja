<?php

use Application\Model\Entity\Produto;

class Application_Service_Produto extends \Core_ServiceLayer_Service
{
    protected $_entityName = 'app:Produto';

    public function getProduto($id)
    {
        return $this->getRepository($this->_entityName)->find($id);
    }

    public function save($params)
    {
        $produto = new Produto();
        $produto->setNoProduto($params['noProduto']);
        $produto->setNuPreco($params['nuPreco']);

        $this->getEntityManager()->persist($produto);
        $this->getEntityManager()->flush();

        return true;
    }

    public function listGrid($params)
    {
        return $this->getRepository($this->_entityName)->listGrid($params);
    }
}