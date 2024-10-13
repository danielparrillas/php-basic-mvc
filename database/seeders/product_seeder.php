<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/models/Product.php';

// Crear una conexión con la base de datos
$database = new Database();
$db = $database->connect();

// Crear el modelo de producto
$product = new Product($db);

// Array de productos para el seeder
$products = [
	['category_id' => 1, 'name' => 'Paracetamol', 'price' => 2.50, 'description' => 'Analgésico común para el dolor y la fiebre.'],
	['category_id' => 2, 'name' => 'Cafcit', 'price' => 10.00, 'description' => 'Estimulante respiratorio para prematuros.'],
	['category_id' => 3, 'name' => 'Lidocaína', 'price' => 5.00, 'description' => 'Anestésico local usado en procedimientos médicos.'],
	['category_id' => 4, 'name' => 'Almagato', 'price' => 3.00, 'description' => 'Antiácido para aliviar el reflujo y acidez estomacal.'],
	['category_id' => 5, 'name' => 'Fluoxetina', 'price' => 12.00, 'description' => 'Antidepresivo utilizado para tratar la depresión y otros trastornos.'],
	['category_id' => 6, 'name' => 'Amoxicilina', 'price' => 8.00, 'description' => 'Antibiótico usado para tratar diversas infecciones bacterianas.'],
	['category_id' => 1, 'name' => 'Ibuprofeno', 'price' => 4.50, 'description' => 'Analgésico y antiinflamatorio utilizado para el alivio de dolores.'],
	['category_id' => 1, 'name' => 'Aspirina', 'price' => 3.20, 'description' => 'Analgésico para el dolor leve y anticoagulante.'],
	['category_id' => 2, 'name' => 'Modafinil', 'price' => 20.00, 'description' => 'Estimulante usado para tratar la somnolencia excesiva.'],
	['category_id' => 2, 'name' => 'Doxapram', 'price' => 18.00, 'description' => 'Analéptico utilizado para estimular la respiración en emergencias.'],
	['category_id' => 3, 'name' => 'Bupivacaína', 'price' => 6.50, 'description' => 'Anestésico local utilizado en procedimientos quirúrgicos.'],
	['category_id' => 3, 'name' => 'Propofol', 'price' => 25.00, 'description' => 'Anestésico intravenoso usado para inducción y mantenimiento de la anestesia.'],
	['category_id' => 4, 'name' => 'Ranitidina', 'price' => 5.50, 'description' => 'Antiácido que se utiliza para reducir la producción de ácido estomacal.'],
	['category_id' => 5, 'name' => 'Sertralina', 'price' => 11.00, 'description' => 'Antidepresivo para el tratamiento de la depresión y ansiedad.'],
	['category_id' => 6, 'name' => 'Ciprofloxacina', 'price' => 15.00, 'description' => 'Antibiótico usado para tratar diversas infecciones bacterianas.'],
	['category_id' => 6, 'name' => 'Azitromicina', 'price' => 14.00, 'description' => 'Antibiótico de amplio espectro usado para infecciones respiratorias y otras.'],

];

// Insertar los productos
foreach ($products as $productData) {
	$product->category_id = $productData['category_id'];
	$product->name = $productData['name'];
	$product->price = $productData['price'];
	$product->description = $productData['description'];

	if ($product->create()) {
		echo "Producto '{$product->name}' insertado con éxito.\n";
	} else {
		echo "Error al insertar el producto '{$product->name}'.\n";
	}
}
