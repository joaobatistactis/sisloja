<?php

class Core_Controller_Action extends Zend_Controller_Action
{
    public function indexAction()
    {

    }

    /**
     * @return Bisna\Service\Service
     */
    public function getService($service = null)
    {
        if (null === $service) {
            $service = $this->_service;
        }

        return $this->getServiceLocator()->getService($service);
    }

    /**
     * @return Bisna\Service\ServiceLocator
     */
    public function getServiceLocator()
    {
        return Zend_Registry::get('serviceLocator');
    }


    public function saveAction()
    {
        $params = $this->getAllParams();
        try {
            $this->getService($this->_service)->save($params);
            $this->setMessage('sucesso', 'Incluido com sucesso');
        } catch (Exception $e){
            $this->setMessage('erro', $e->getMessage());
        }

        //retorna para a pagina create
        $this->redirect('produto/produto/index');
    }

    public function setMessage($type,$msg)
    {
        $this->_helper->FlashMessenger->addMessage(array($type => $msg));
    }
}
