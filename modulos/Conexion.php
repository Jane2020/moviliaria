 <?php
define("PATH_ROOT", __DIR__);
require_once(PATH_ROOT . "/../config/config.inc");

Class Conexion {
	private $host;
	private $user;
	private $pass;
	private $bd;
	
	/**
	 * Conexión con la base de datos
	 */
   	public function conectar(){
   		$this->host = HOSTNAME_DATABASE;
   		$this->user = USERNAME;
   		$this->pass = PASSWORD;
   		$this->db = DATABASE;
   	
	    $mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
	    if ($mysqli->connect_errno)
	       header('Location: error500.html');
	    $mysqli->set_charset('utf8');
	    return $mysqli;
   	}
}