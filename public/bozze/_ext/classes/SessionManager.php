<?php

class SessionManager 
{
	public $site;
	
	public function __construct($site)
	{
		$this->site = $site;
	}
	
	public function login($id_user)
	{
		$this->setSessionVariable('auth', '1');
		$this->setSessionVariable('id_user', $id_user);
		
	}
	
	public function destroySession()
	{
		session_unset();
		session_destroy();
		session_regenerate_id();
	}
	
	public function setSessionVariable($var, $val)
	{
		$_SESSION[$var] = $val;
	}
}

?>