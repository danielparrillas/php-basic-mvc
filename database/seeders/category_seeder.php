<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/models/Category.php';

// Crear una conexión con la base de datos
$database = new Database();
$db = $database->connect();

$category = new Category($db);

$categories = [
	['id' => 1, 'name' => 'Analgésico'],
	['id' => 2, 'name' => 'Analéptico'],
	['id' => 3, 'name' => 'Anestésico'],
	['id' => 4, 'name' => 'Antiácido'],
	['id' => 5, 'name' => 'Antidepresivo'],
	['id' => 6, 'name' => 'Antibiótico'],
];

// Insertar las categorías
foreach ($categories as $categoryData) {
	$category->id = $categoryData['id']; // Si la base de datos permite insertar manualmente IDs
	$category->name = $categoryData['name'];

	if ($category->create()) {
		echo "Categoría '{$category->name}' insertada con éxito.\n";
	} else {
		echo "Error al insertar la categoría '{$category->name}'.\n";
	}
}
