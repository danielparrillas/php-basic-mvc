<?php
session_start();

require_once __DIR__ . '/../middlewares/authMiddleware.php';
require_once __DIR__ . '/../middlewares/roleMiddleware.php';

switch ($_SERVER['REQUEST_URI']) {
	case '/':
		require_once __DIR__ . '/../app/views/home.php';
		break;
	case '/dashboard':
		auth();
		role('admin');
		require_once __DIR__ . '/../app/controllers/DashboardController.php';
		$dashboardController = new DashboardController();
		$dashboardController->showDashboard();
		break;
	case '/login':
		require_once __DIR__ . '/../app/controllers/AuthController.php';
		$authController = new AuthController();
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$authController->showLoginForm();
				break;
			case 'POST':
				$authController->login();
				break;
		}
		break;
	case '/logout':
		require_once __DIR__ . '/../app/controllers/AuthController.php';
		$authController = new AuthController();
		$authController->logout();
		break;
	case '/register':
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				require_once __DIR__ . '/../app/views/register.php';
				break;
			case 'POST':
				require_once __DIR__ . '/../app/controllers/AuthController.php';
				$authController = new AuthController();
				$authController->register();
				break;
		}
		break;
	case '/productos':
		require_once __DIR__ . '/../app/controllers/ProductController.php';
		$productController = new ProductController();
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$productController->index();
				break;
			case 'POST':
				$productController->create();
				break;
		}
		break;
	default:
		http_response_code(404);
		require_once __DIR__ . '/../app/views/404.php';
		break;
}
