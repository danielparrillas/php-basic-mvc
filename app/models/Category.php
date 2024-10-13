<?php
require_once __DIR__ . '/Model.php';

class Category extends Model
{
	public $name;
	protected $table = 'categories';

	public function __construct($db)
	{
		parent::__construct($db);
	}

	// Método para crear una nueva categoría
	public function create()
	{
		$query = 'INSERT INTO ' . $this->table . ' (name) VALUES (:name)';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':name', $this->name);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	// Método para actualizar una categoría
	public function update()
	{
		$query = 'UPDATE ' . $this->table . ' SET name = :name WHERE id = :id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
}
