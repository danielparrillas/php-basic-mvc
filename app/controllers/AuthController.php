<?php
class AuthController
{
	private $db;

	public function __construct()
	{
		$this->db = (new Database())->connect();
	}

	public function showLoginForm()
	{
		session_start();
		if (isset($_SESSION['user_id'])) {
			header('Location: /dashboard');
		} else {
			require_once __DIR__ . '/../views/login.php';
		}
	}

	public function login()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		require_once __DIR__ . '/../models/User.php';
		$user = new User($this->db);
		$user->email = $email;
		$user->password = $password;
		$loggedInUser = $user->login();
		if ($loggedInUser) {
			session_start();
			$_SESSION['user_id'] = $loggedInUser['id'];
			$_SESSION['user_email'] = $loggedInUser['email'];
			header('Location: /dashboard');
		} else {
			$error = 'Invalid login credentials';
			require_once __DIR__ . '/../views/login.php';
		}
	}
}
