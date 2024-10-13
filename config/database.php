<?php
class Database
{
	private $host = '127.0.0.1';
	private $db_name = 'php_mvc';
	private $username = 'root';
	private $password = 'root';
	public $conn;

	// Cambiar el nombre de la función a connect() para usar MySQL.
	public function connect()
	{
		$this->conn = null;

		try {
			$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			// echo 'Connection Error: ' . $e->getMessage();
		}

		return $this->conn;
	}

	// Cambiar el nombre de la función a connect() para usar SQLite.
	public function ___()
	{
		$db_name_example = __DIR__ . '/../database/example.db';
		try {
			// Cambiamos el DSN para usar SQLite.
			$this->conn = new PDO('sqlite:' . $db_name_example);
			// Configuramos el modo de error de PDO a EXCEPTION para manejar errores.
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Connection Error: ' . $e->getMessage();
		}

		return $this->conn;
	}

	public function close()
	{
		$this->conn = null;
	}

	public function __destruct()
	{
		$this->close();
	}
}
