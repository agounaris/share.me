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
 * @version    SVN: $Id: sfGuardPermissionPeer.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardPermissionPeer extends PluginsfGuardPermissionPeer
{
    public static function getPermissionArray(){
        $permissions = self::getName();
        $result = array();
        foreach($permissions as $permission){
            $result[$permission->getId()] = $permission->getName();
        }
        asort($result);
        return $result;
    }
}
