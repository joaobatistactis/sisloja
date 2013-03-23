<?php

 use Bisna\Service\Service as ServiceBisna;
/**
 *  CategoriaController
 *
 * @author Administrator
 */
class Core_ServiceLayer_Service extends ServiceBisna
{
    public $serviceName = null;

    /**
     * @return \Bisna\Service\Service
     */
    public function getService()
    {
        if ($this->serviceName == null) {
            throw new \Exception('Defina o nome do serviço');
        }

        return $this->getServiceLocator()->getService($this->serviceName);
    }

    public function find($entityName,$id)
    {
        $em = $this->getEntityManager();
        return $em->find($entityName, $id);
    }


    public function findBy($entityName, $criteria)
    {
        $em = $this->getEntityManager();
        return $em->findAll($entityName, $criteria);
    }

    public function getRepository($entityName)
    {
    	$em = $this->getEntityManager();

    	return $em->getRepository($entityName);
    }
}

?>
