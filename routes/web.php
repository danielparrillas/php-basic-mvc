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
		echo 'Home';
		break;
	case '/dashboard':
		auth();
		echo 'Dashboard';
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
	default:
		http_response_code(404);
		echo '404 Not Found';
		break;
}
