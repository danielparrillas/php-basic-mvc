<?php
class User
{
	private $conn;
	private $table = 'users';

	public $name;
	public $email;
	public $password;
	public $role;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function login()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email LIMIT 1';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $this->email);
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($user && password_verify($this->password, $user['password'])) {
			return $user;
		}

		return false;
	}

	// Método para registrar un nuevo usuario
	public function register()
	{
		// Verificar si el email ya existe
		$query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email LIMIT 1';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $this->email);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			return false; // El email ya está registrado
		}

		// Insertar un nuevo usuario
		$query = 'INSERT INTO ' . $this->table . ' (name, email, password, role) VALUES (:name, :email, :password, :role)';
		$stmt = $this->conn->prepare($query);

		// Encriptar la contraseña antes de guardarla
		$hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

		// Asignar los valores
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', $hashedPassword);
		$stmt->bindParam(':role', $this->role);

		// Ejecutar la consulta
		if ($stmt->execute()) {
			return true; // Registro exitoso
		}

		return false; // Error al registrar el usuario
	}
}
