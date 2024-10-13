<?php

class Controller
{
	protected $db;

	public function __construct()
	{
		$this->db = (new Database())->connect();
	}
}
