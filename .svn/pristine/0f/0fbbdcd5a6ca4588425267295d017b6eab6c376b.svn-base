<?php
/**
 * Created by JetBrains PhpStorm.
 * User: agounaris
 * Date: 07/09/12
 * Time: 11:06
 * To change this template use File | Settings | File Templates.
 */

class ClientFilter extends sfFilter
{

    public function Execute($filterChain)
    {

        $action = $this->context->getModuleName().$this->context->getActionName();
        if ( $this->isFirstCall() && $action != "contentassign" ) {

            var_dump($action);

            if ( $action != "sfGuardAuthsignin" || $action != "logout" ) {

                if ( $this->getContext()->getUser()->isAuthenticated() ) {

                    //$start = microtime();

                    $user = $this->getContext()->getUser();

                    if ( $user->getAttribute('group') == 'none' && $user->getAttribute('project') == 'none' ) {
                        //$this->redirect('content/assign');
                        $this->getContext()->getController()->redirect('content/assign');
                        throw new sfStopException();
                    }

                }
            }

        }
        $filterChain->execute();

    }

}