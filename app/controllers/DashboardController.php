<?php
require_once __DIR__ . '/Controller.php';

class DashboardController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function showDashboard()
	{
		if (!isset($_SESSION['user_id'])) {
			header('Location: /login');
		}
		require_once __DIR__ . '/../models/Product.php';
		require_once __DIR__ . '/../models/Category.php';
		$product = new Product($this->db);
		$category = new Category($this->db);

		$categories = $category->getAll();
		$products = $product->getAll();

		require_once __DIR__ . '/../views/dashboard.php';
	}
}
