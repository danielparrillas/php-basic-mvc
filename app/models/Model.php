<?php

class Model
{
	protected $conn;
	protected $table;
	public $id;
	public $created_at;
	public $updated_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	// Método para obtener todos los registros
	public function getAll()
	{
		$query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Método para obtener un registro por su ID
	public function getById()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id LIMIT 1';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Método para eliminar
	public function delete()
	{
		$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
}
