<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initAutoloaderNamespaces()
	{
		require_once APPLICATION_PATH . '/../library/Doctrine/Common/ClassLoader.php';

		$autoloader = \Zend_Loader_Autoloader::getInstance();
		$fmmAutoloader = new \Doctrine\Common\ClassLoader('Bisna');
		$autoloader->pushAutoloader(array($fmmAutoloader, 'loadClass'), 'Bisna');
	}

    static public function modelsAutoload($className)
    {
            Zend_Loader_Autoloader::autoload(str_replace('\\', '_', $className));
    }

    protected function _initAutoload()
    {
        $applicationAutoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Application_',
            'basePath'  => dirname(__FILE__),
        ));

        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->pushAutoloader(array('Bootstrap', 'modelsAutoload'), 'Application\\Model\\');
    }

}

