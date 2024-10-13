<?php
require_once __DIR__ . '/Model.php';

class OrderDetail extends Model
{
	protected $table = 'order_details';

	public $order_id;
	public $product_id;
	public $quantity;
	public $price;
	public $subtotal;

	public function __construct($db)
	{
		parent::__construct($db);
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
}
