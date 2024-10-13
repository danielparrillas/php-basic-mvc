<?php
require_once __DIR__ . '/Model.php';

class Product extends Model
{
	protected $table = 'products';

	public $category_id;
	public $name;
	public $price;
	public $description;

	public function __construct($db)
	{
		parent::__construct($db);
	}

	// Método para obtener productos por categoría
	public function getByCategory()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE category_id = :category_id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->execute();

		return $stmt;
	}

	// Método para crear un nuevo producto
	public function create()
	{
		$query = 'INSERT INTO ' . $this->table . ' (category_id, name, price, description) VALUES (:category_id, :name, :price, :description)';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':description', $this->description);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	// Método para actualizar un producto
	public function update()
	{
		$query = 'UPDATE ' . $this->table . ' SET category_id = :category_id, name = :name, price = :price, description = :description WHERE id = :id';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
}
