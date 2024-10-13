<?php
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderDetail.php';

class OrderController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// Método para crear una nueva orden
	public function create()
	{
		// Recibir los datos del carrito desde el cuerpo de la solicitud
		$data = json_decode(file_get_contents("php://input"), true);

		if (!isset($data['products']) || empty($data['products'])) {
			http_response_code(400);
			echo json_encode(['message' => 'No hay productos en el carrito.']);
			return;
		}

		// Crear una nueva instancia de Order
		$order = new Order($this->db);
		$order->user_id = $_SESSION['user_id']; // Asume que hay una sesión iniciada con un usuario
		$order->total = $data['total'];
		$order->status = 'pending'; // Estado inicial

		// Crear la orden
		if ($order->create()) {
			$orderId = $this->db->lastInsertId(); // Obtener el ID de la orden creada

			// Insertar detalles de la orden
			foreach ($data['products'] as $product) {
				$orderDetail = new OrderDetail($this->db);
				$orderDetail->order_id = $orderId;
				$orderDetail->product_id = $product['id'];
				$orderDetail->quantity = $product['quantity'];
				$orderDetail->price = $product['price'];
				$orderDetail->subtotal = $product['quantity'] * $product['price'];
				$orderDetail->create();
			}

			echo json_encode(['message' => 'Orden creada exitosamente']);
		} else {
			http_response_code(500);
			echo json_encode(['message' => 'Error al crear la orden']);
		}
	}

	// Método para listar todas las órdenes
	public function index()
	{
		$order = new Order($this->db);
		$order->user_id = $_SESSION['user_id'];
		$orders = $order->getByUserId();

		require_once __DIR__ . '/../views/orders.php';
	}

	// Método para obtener una orden específica por ID
	public function show($id)
	{
		$order = new Order($this->db);
		$order->id = $id;
		$orderData = $order->getById();

		if ($orderData) {
			echo json_encode($orderData);
		} else {
			http_response_code(404);
			echo json_encode(['message' => 'Orden no encontrada']);
		}
	}

	// Método para eliminar una orden (estado cancelado)
	public function delete()
	{
		$order = new Order($this->db);
		$order->id = $_POST['order_id'];
		$order->status = 'canceled';

		if ($order->cancelar()) {
			header('Location: /orders');
		} else {
			http_response_code(500);
			$error = "Error al cancelar la orden";
		}
	}
}
