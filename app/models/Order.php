<?php
require_once __DIR__ . '/Model.php';

class Order extends Model
{
	protected $table = 'orders';

	public $user_id;
	public $total;
	public $status;

	public function __construct($db)
	{
		parent::__construct($db);
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
}
