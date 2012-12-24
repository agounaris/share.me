<?php


/**
 * Skeleton subclass for representing a row from the 'ldap_sf_user' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Jun 28 05:46:05 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class LDAPSfUser extends BaseLDAPSfUser {

	protected $cn;
	protected $uid;
	protected $sn;
	protected $title;
	protected $uidNumber;
	protected $gidNumber;
	protected $homeDirectory;
	protected $loginShell = "/bin/false";
	protected $objectClass  = array("account", "posixAccount");
	protected $server;
	
	public function __construct(){
	}

	public function setServer($ldapServer){
		$this->server = $ldapServer;
	}

	public function getServer(){
		return $this->server;
	}

	public function getUser($username, $attributes = null){
		$filter          	= "uid=$username";
		if($attributes == null){
			$attributes      	= array('cn', 'uid', 'displayName', 'sn', 'title', 'mail', 'uidNumber', 'gidNumber', 'homeDirectory', 'loginShell', 'objectClass') ;
		}
		$distinguishedName  = $this->server->getUserdn();

		$result = $this->server->search($distinguishedName, $filter, $attributes);

		$data = array();
		for ($i=0; $i<=$result["count"];$i++) {
			if(isset($result[$i])){
				for ($j=0;$j<=$result[$i]["count"];$j++){
					if(!empty($result[$i][$j])) $data[$result[$i][$j]] = $result[$i][$result[$i][$j]][0];
				}
			}
		}
		return $data;
	}

	public function addUser($user){
		if(empty($user)) return null;
		if(isset($user['uid'])){
			$distinguishedName = "{$this->server->getUserAttr()}={$user['uid']},{$this->server->getUserdn()}";
		} elseif($user['userid']){
			$distinguishedName = "{$this->server->getUserAttr()}={$user['userid']},{$this->server->getUserdn()}";
		}else {
			$distinguishedName = "cn={$user['cn']},{$this->server->getUserdn()}";
		}

		$res = ldap_add($this->server->getConnection(), $distinguishedName, $user);
		if($res === false){
			$error_no = ldap_errno($this->server->getConnection());
			$error    = ldap_error($this->server->getConnection());
			echo "Add User error $error_no: $error\n";
		}
		return $res;
	}

	public function deleteUser($user){
		if(empty($user)) return null;
		if(isset($user['uid'])){
			$distinguishedName = "uid={$user['uid']},{$this->server->getUserdn()}";
		} elseif($user['userid']){
			$distinguishedName = "uid={$user['userid']},{$this->server->getUserdn()}";
		}else {
			$distinguishedName = "cn={$user['cn']},{$this->server->getUserdn()}";
		}
		$res = ldap_delete($this->server->getConnection(), $distinguishedName);
		return $res;
	}

	public function modifyUser($user){
		if(empty($user)) return null;
		if(isset($user['uid'])){
			$distinguishedName = "uid={$user['uid']},{$this->server->getUserdn()}";
		} elseif($user['userid']){
			$distinguishedName = "uid={$user['userid']},{$this->server->getUserdn()}";
		}else {
			$distinguishedName = "cn={$user['cn']},{$this->userdn}";
		}

		return $this->modifyAttributes($distinguishedName, $user);
	}

	public function changePassword($username, $password){
		$result = false;
		$user = $this->getUser($username);
		if(!empty($user)){
			$hashed_password = strtoupper(bin2hex(mhash(MHASH_MD4, iconv("UTF-8","UTF-16LE", $password))));;
            $sambaPwdLastSet 	= strtotime("now");
            $sambaPwdMustChange = strtotime("now + 45 days");
			
			$attributes = array( 'mail' 				=> $user['mail']
							   , 'userPassword' 		=> $password
							   , 'sambaNTPassword' 		=> $hashed_password
							   , 'sambaPwdLastSet'		=> $sambaPwdLastSet
							   , 'sambaPwdMustChange'  	=> $sambaPwdMustChange
							   );

			if(isset($user['uid'])){
				$distinguishedName = "uid={$user['uid']},{$this->server->getUserdn()}";
			} elseif($user['userid']){
				$distinguishedName = "uid={$user['userid']},{$this->server->getUserdn()}";
			}else {
				$distinguishedName = "cn={$user['cn']},{$this->userdn}";
			}

			$result = ldap_modify($this->server->getConnection(), $distinguishedName, $attributes);

			$error  = ldap_error($this->server->getConnection());
			echo $error;
		}
		return $result;
	}

	function modifyAttributes($dn, $attributes) {

		foreach ($attributes as $key => $cur_val) {
			if ($cur_val == '') {
				unset($attributes[$key]);
			/*	$old_value = $this->retrieveAttribute($dn, $key);
				if (isset($old_value)) {
					ldap_mod_del($this->server->getConnection(), $dn, array($key => $old_value));
				}*/
			}
			if (is_array($cur_val)) {
				foreach ($cur_val as $mv_key => $mv_cur_val) {
					if ($mv_cur_val == '') {
						unset($attributes[$key][$mv_key]);
					} else {					
						$attributes[$key][$mv_key] = $mv_cur_val;
					}
				}
			}
		}		
		return ldap_modify($this->server->getConnection(), $dn, $attributes);
	}


	function getUsers(){

		$filter          = "uid=*";
		$attributes      = array('cn'
		, 'displayName'
		, 'ou'
		, 'physicalDeliveryOfficeName'
		, 'title'
		, 'telephoneNumber'
		, 'sn'
		, 'givenName'
		, 'homeDirectory'
		, 'mail'
		, 'mobile'
		, 'loginShell'
		, 'homePhone'
		, ) ;
		$distinguishedName  = $this->server->getUserdn();
			
		$results = $this->server->search($distinguishedName, $filter, $attributes);
		$data = array();
		foreach ($results as $key=>$val) {
			if(is_array($val)){
				foreach($val as $k=>$v){
					if(!is_numeric($k)){
						if(isset($v["count"]) && $v["count"] == 1){
							$data[$key][$k] = $v[0];
						}
					}
				}
			}
		}
		return $data;
	}

	public function addUpdatesfGuardUser($user){
		if(isset($user['cn'])){
			$sf_user = sfGuardUserPeer::retrieveByUsername($user["cn"]);
			if($sf_user == null){
				try {
					$sfGuardUser = new sfGuardUser();
					$sfGuardUser->setUsername($user["cn"]);
					$sfGuardUser->setIsActive(1);
					$sfGuardUser->save();

					$userProfile = new sfGuardUserProfile();
					$userProfile->setUserId($sfGuardUser->getId());
					if(isset($user["givenname"])) $userProfile->setFirstName($user["givenname"]);
					if(isset($user["sn"])) $userProfile->setLastName($user["sn"]);
					if(isset($user["title"])) $userProfile->setJobTitle($user["title"]);
					if(isset($user["mail"])) $userProfile->setEmail($user["mail"]);
					if(isset($user["telephonenumber"])) $userProfile->setTelephone($user["telephonenumber"]);
					if(isset($user["homephone"])) $userProfile->setHomePhone($user["homephone"]);
					if(isset($user["mobile"])) $userProfile->setMobile($user["mobile"]);
					if(isset($user["ou"])) $userProfile->setDepartment($user["ou"]);
					if(isset($user["physicaldeliveryofficename"])) $userProfile->setOffice($user["physicaldeliveryofficename"]);
					$userProfile->save();
				} catch (Exception $e){
				}
			} else {
				try {
					$sf_user = sfGuardUserPeer::retrieveByUsername($user["cn"]);
					if(is_object($sf_user)){
						$userProfile = $sf_user->getsfGuardUserProfile();
						$userProfile->setUserId($sfGuardUser->getId());
						if(isset($user["givenname"])) $userProfile->setFirstName($user["givenname"]);
						if(isset($user["sn"])) $userProfile->setLastName($user["sn"]);
						if(isset($user["title"])) $userProfile->setJobTitle($user["title"]);
						if(isset($user["mail"])) $userProfile->setEmail($user["mail"]);
						if(isset($user["telephonenumber"])) $userProfile->setTelephone($user["telephonenumber"]);
						if(isset($user["homephone"])) $userProfile->setHomePhone($user["homephone"]);
						if(isset($user["mobile"])) $userProfile->setMobile($user["mobile"]);
						if(isset($user["ou"])) $userProfile->setDepartment($user["ou"]);
						if(isset($user["physicaldeliveryofficename"])) $userProfile->setOffice($user["physicaldeliveryofficename"]);
						$userProfile->save();
					}
				}catch (Exception $e){
				}
			}
		}
	}
	
} // LDAPSfUser
