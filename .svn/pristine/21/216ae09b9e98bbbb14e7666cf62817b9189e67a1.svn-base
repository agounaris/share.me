<?php

class LDAPAuth extends LDAPServer {
	
	protected $server;
	
	public function __construct(){
		parent::__construct();
	}

	public function setServer($ldapServer){
		$this->server = $ldapServer;		
	}
	 
	public function login($username, $password){
		return $this->server->connect($username, $password);
	}
	
	public function logout(){
		return $this->server->disconnect();
	}
}