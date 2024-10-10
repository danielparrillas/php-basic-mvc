<?php

function auth()
{
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header('Location: /login');
	}
}

switch ($_SERVER['REQUEST_URI']) {
	case '/':
		require_once __DIR__ . '/../app/views/home.php';
		break;
	case '/dashboard':
		auth();
		require_once __DIR__ . '/../app/views/dashboard.php';
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
	default:
		http_response_code(404);
		require_once __DIR__ . '/../app/views/404.php';
		break;
}
