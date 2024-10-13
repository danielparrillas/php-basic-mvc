<?php
class OrderDetail
{
	private $conn;
	private $table = 'order_details';

	public $id;
	public $order_id;
	public $product_id;
	public $quantity;
	public $price;
	public $subtotal;
	public $created_at;
	public $updated_at;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	// Método para obtener todos los detalles de órdenes
	public function getAll()
	{
		$query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Método para obtener detalles de una orden por su ID
	public function getByOrderId()
	{
		$query = 'SELECT * FROM ' . $this->table . ' WHERE order_id = :order_id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':order_id', $this->order_id);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Método para crear un nuevo detalle de orden
	public function create()
	{
		$query = 'INSERT INTO ' . $this->table . ' (order_id, product_id, quantity, price, subtotal) 
                  VALUES (:order_id, :product_id, :quantity, :price, :subtotal)';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':order_id', $this->order_id);
		$stmt->bindParam(':product_id', $this->product_id);
		$stmt->bindParam(':quantity', $this->quantity);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':subtotal', $this->subtotal);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	// Método para actualizar un detalle de orden
	public function update()
	{
		$query = 'UPDATE ' . $this->table . ' SET order_id = :order_id, product_id = :product_id, 
                  quantity = :quantity, price = :price, subtotal = :subtotal WHERE id = :id';
		$stmt = $this->conn->prepare($query);

		// Bind de los parámetros
		$stmt->bindParam(':order_id', $this->order_id);
		$stmt->bindParam(':product_id', $this->product_id);
		$stmt->bindParam(':quantity', $this->quantity);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':subtotal', $this->subtotal);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	// Método para eliminar un detalle de orden
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
