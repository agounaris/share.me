<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserPeer.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardUserPeer extends PluginsfGuardUserPeer
{
    public static function getUsers(){
		
	}
        public static function fetchPer($option){
		$c = new Criteria();
		$c->add(sfGuardUserPeer::ID, $option['id']);
		$v = sfGuardUserPeer::doSelect($c);
               // var_dump($v); 
		return $v;
	}
}
