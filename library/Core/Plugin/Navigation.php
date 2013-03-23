<?php
namespace Core\Plugin;
/*
 * Workshop Doctrine 2 + ZF1
*
*/
use \Zend_Config_Xml as XML,
\Zend_Navigation as NavigationContainer,
\Zend_Controller_Action_HelperBroker as HelpBroker;
/**
 *  Navigation
 *
 * @author Administrator
 */
class Navigation extends \Zend_Controller_Plugin_Abstract
{
	public function preDispatch(\Zend_Controller_Request_Abstract $request)
	{
		$config = new XML(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
		$navigation = new NavigationContainer($config);
		$view = HelpBroker::getExistingHelper('ViewRenderer')->view;

		//pega página ativa
		$paginaAtiva = $view->navigation($navigation)->findOneBy('active', true);

		if ($paginaAtiva) {
			$label = $paginaAtiva->get('label');
			$view->title = $label;
		}
	}
}