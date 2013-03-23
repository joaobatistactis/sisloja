<?php
class Core_View_Helper_Message extends Zend_View_Helper_Abstract
{
    public function message()
    {
        $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();
        if ($messages) {
            foreach (current($messages) as $key => $message)
            {
                switch ($key){
                    case 'sucesso':
                       $userMessage = '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert">x</button>
                        '.$message.'
                        </div>';
                        break;
                    case 'erro':
                        $userMessage = '<div class="alert alert-error">
                        <button class="close" data-dismiss="alert">x</button>
                        '.$message.'
                        </div>';
                        break;
                }
            }
            return $userMessage;
        }
    }
}