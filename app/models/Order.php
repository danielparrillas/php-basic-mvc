<?php
class Order
{
	private $conn;
	private $table = 'orders';

	public $id;
	public $user_id;
	public $total;
	public $status;
	public $created_at;
	public $updated_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	// Método para obtener todas las órdenes
	public function getAll()
	{
		$query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Método para obtener todas las órdenes de un usuario
	public function getByUserId()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id ORDER BY created_at DESC';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Método para obtener una orden por su ID
	public function getById()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id LIMIT 1';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Método para crear una nueva orden
	public function create()
	{
		$query = 'INSERT INTO ' . $this->table . ' (user_id, total, status) VALUES (:user_id, :total, :status)';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->bindParam(':total', $this->total);
		$stmt->bindParam(':status', $this->status);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	// Método para actualizar una orden
	public function update()
	{
		$query = 'UPDATE ' . $this->table . ' SET user_id = :user_id, total = :total, status = :status WHERE id = :id';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->bindParam(':total', $this->total);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	public function cancelar()
	{
		$query = 'UPDATE ' . $this->table . ' SET status = :status WHERE id = :id';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	// Método para eliminar una orden
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
