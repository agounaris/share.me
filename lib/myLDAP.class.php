<?php
class myLDAP extends sfGuardSecurityUser{

	public static function checkLDAPPassword($username, $password)
	{  
		$ldapServers = LDAPServerPeer::getActive();
		$ldapServer = $ldapServers[0];
		$ldapServer->connect();

		$ldapUser = new LDAPSfUser();
		$ldapUser->setServer($ldapServer);

		if($user = $ldapUser->getUser($username)){
			$ldapAuth = new LDAPAuth();
			$ldapAuth->setServer($ldapServer);
			if($ldapAuth->login($username, $password))
			{
				return true;
			}
		}
		return false;
	}
}