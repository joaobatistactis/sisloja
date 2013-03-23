<?php
class Produto_ProdutoController extends Core_Controller_Action
{
    protected $_service = 'Produto';
    public function indexAction()
    {
    }

    public function createAction()
    {
    	
    }

    public function listAction()
    {
        $this->_helper->layout->disableLayout();
        $params = $this->_getAllParams();
        $this->view->result = $this->getService($this->_service)->listGrid($params);
    }
}