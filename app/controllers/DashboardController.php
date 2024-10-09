<?php

class DashboardController
{
	private $db;

	public function __construct()
	{
		$this->db = (new Database())->connect();
	}

	public function showDashboard()
	{
		session_start();

		if (!isset($_SESSION['user_id'])) {
			header('Location: /login');
		}

		require_once __DIR__ . '/../views/dashboard.php';
	}
}
