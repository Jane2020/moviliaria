<?php
Class Conexion {
	private $host;
	private $user;
	private $pass;
	private $bd;
	
	/**
	 * Conexión con la base de datos
	 */
   	public function conectar(){
   		$this->host = 'localhost';
   		$this->user = 'root';
   		$this->pass = '123456';
   		$this->db = 'movliaria';
   	
	    $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
	    if ($mysqli->connect_errno)
	       header('Location: offline.html');
	    $mysqli->set_charset('utf8');
	    return $mysqli;
   	}
}