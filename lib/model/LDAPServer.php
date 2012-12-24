<?php


/**
 * Skeleton subclass for representing a row from the 'ldap_server' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Aug  8 06:10:34 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    plugins.sfGuardLDAPExtrasPlugin.lib.model
 */
class LDAPServer extends BaseLDAPServer {

	/**
	 * Initializes internal state of LDAPServer object.
	 * @see        parent::__construct()
	 */
	protected $connection;
	protected $version;

	public function __construct()
	{
		parent::__construct();

		$this->connection = null;
		$this->version = 3;
	}

	protected function getActive(){
		$ldapServers = LDAPServerPeer::getActive();		
		if(isset($ldapServers[0])&& is_object($ldapServers[0])){
			$ldapServer = $ldapServers[0];
			$this->id   = $ldapServer->getId();
			$this->name = $ldapServer->getName();
			$this->host = $ldapServer->getHost();
			$this->port = $ldapServer->getPort();
			$this->tls  = $ldapServer->getTls();
			$this->basedn = $ldapServer->getBasedn();
			$this->binddn = $ldapServer->getBinddn();
			$this->bindpasswd =  $ldapServer->getBindpasswd();
			$this->user_prefix =  $ldapServer->getUserPrefix();
			$this->group_prefix =  $ldapServer->getGroupPrefix();
			$this->user_attr = $ldapServer->getUserAttr();
		}
	}
	
	public function getConnection(){
		return $this->connection;
	}

	public function getGroupdn(){
		return $this->getGroupPrefix().','.$this->getBasedn();
	}
	
    public function getUserdn(){
		return $this->getUserPrefix().','.$this->getBasedn();
	}
	public function connect($user = null, $password = null){
		
		$this->getActive();
		
		$this->connection = ldap_connect($this->host);
		
		if ($this->connection) {
			if (ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, $this->version))
			{
				$this->version = "3";
			}else{
				$this->version = "2";
			}
				
			ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);
			if ($this->tls) {
				ldap_get_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, $vers);
				if ($vers == -1) {
					//log 'Could not get LDAP protocol version.'
					return;
				}
				if ($vers != 3) {
					//log Could not start TLS, only supported by LDAP v3.
					return;
				} else if (!function_exists('ldap_start_tls')) {
					//log Could not start TLS. It does not seem to be supported by this PHP setup.
					return;
				} else if (!ldap_start_tls($con)) {
					// Could not start TLS. (Error %errno: %error).', array('%errno' => ldap_errno($con), '%error' => ldap_error($con)), WATCHDOG_ERROR);
					return;
				}
			}
			
			if(!empty($user) && $user != "admin"){
				$distinguishedName  = "uid=$user,{$this->getUserdn()}";
			}else{
				$distinguishedName  = $this->binddn;
				$password           = $this->bindpasswd; 
			}
			
			$res = @ldap_bind($this->connection, $distinguishedName, $password);
			if($res === true) {
				$this->connected = true;
				return true;
			} elseif ($res === false) {
				//$error_no = ldap_errno($this->connection);
				//$error    = ldap_error($this->connection);
				//echo "Bind error $error_no: $error\n";
				ldap_close($this->connection);
				return false;
			}
		}
	}

	function disconnect() {
		if ($this->connection) {
			@ldap_unbind($this->connection);
			@ldap_close($this->connection);
		}
		$this->connected = false;
	}

	public function close(){
		$this->disconnect();
	}

	public function search($distinguishedName, $filter, $attributes = array('dn')){
		$result = null;
		echo "$distinguishedName, $filter";
		$searchResult = ldap_search($this->connection, $distinguishedName, $filter, $attributes);
		if($searchResult && ldap_count_entries($this->connection, $searchResult)) {
			$result = ldap_get_entries($this->connection, $searchResult);
		}
		return $result;
	}


	function create_entry($dn, $attributes) {
		//set_error_handler(array('LDAPInterface', 'void_error_handler'));
		$ret = ldap_add($this->connection, $dn, $attributes);
		//restore_error_handler();

		return $ret;
	}

	function rename_entry($dn, $newrdn, $newparent, $deleteoldrdn) {
		//set_error_handler(array('LDAPInterface', 'void_error_handler'));
		$ret = ldap_rename($this->connection, $dn, $newrdn, $newparent, $deleteoldrdn);
		//restore_error_handler();

		return $ret;
	}

	function delete_entry($dn) {
		//set_error_handler(array('LDAPInterface', 'void_error_handler'));
		$ret = ldap_delete($this->connection, $dn);
		//restore_error_handler();

		return $ret;
	}

	function deleteAttribute($dn, $attribute) {
		ldap_mod_del($this->connection, $dn, array($attribute => array()));
	}
} // LDAPServer