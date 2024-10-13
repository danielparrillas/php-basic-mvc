<?php
$title = 'Productos';
require_once __DIR__ . '/components/header.php';
?>

<body>
	<?php require_once __DIR__ . '/components/navbar.php'; ?>

	<section class="py-20 bg-gray-50">
		<div class="container mx-auto px-6">
			<h2 class="text-3xl font-bold text-center text-gray-800">
				Productos
			</h2>
			<button id="cart-button" class="sticky top-16 right-0 border-none bg-green-600">
				<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
					<path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
				</svg>

			</button>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
				<?php foreach ($products as $product) : ?>
					<div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
						<div class="text-indigo-500 mb-4">
							<i class="fas fa-box text-4xl"></i>
						</div>
						<h3 class="text-xl font-semibold mb-2 text-gray-600"><?= $product['name'] ?></h3>
						<p class="text-gray-600"><?= $product['description'] ?></p>
						<p class="text-gray-600 mt-4 font-semibold">$<?= $product['price'] ?></p>
						<!-- Botón para agregar al carrito -->
						<button class="bg-indigo-500 text-white px-4 py-2 mt-4 rounded" onclick="addToCart(<?= $product['id'] ?>, '<?= $product['name'] ?>', <?= $product['price'] ?>)">
							Añadir al carrito
						</button>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<dialog id="carrito-dialog">
		<article>
			<header>
				<button aria-label="Close" rel="prev"></button>
				<p>
					<strong>Carrito</strong>
				</p>
			</header>
			<!-- Carrito -->
			<div class="container mx-auto px-6 mt-12">
				<ul id="cart-items" class="mb-6"></ul>
				<p id="cart-total" class="text-lg font-semibold mb-6">Total: $0</p>
				<div class="flex justify-between">
					<button class="bg-green-500 px-6 py-2 rounded border-none" onclick="createOrder()">Crear Orden</button>
					<button id="cancelar-button" class="bg-red-500 px-6 py-2 rounded border-none">Cancelar</button>
				</div>
			</div>
		</article>

		<script>
			const cartButton = document.getElementById('cart-button');
			const carritoDialog = document.getElementById('carrito-dialog');
			const cancelarButton = document.getElementById('cancelar-button');

			cartButton.addEventListener('click', () => {
				carritoDialog.showModal();
			});
			carritoDialog.querySelector('button[rel="prev"]').addEventListener('click', () => {
				carritoDialog.close();
			});

			cancelarButton.addEventListener('click', () => {
				//recargar pagina
				location.reload();
			});



			let cart = [];

			// Función para añadir productos al carrito
			function addToCart(id, name, price) {
				const product = cart.find(item => item.id === id);
				if (product) {
					product.quantity += 1;
				} else {
					cart.push({
						id,
						name,
						price,
						quantity: 1
					});
				}
				updateCartView();
			}

			// Actualizar la vista del carrito
			function updateCartView() {
				const cartItems = document.getElementById('cart-items');
				const cartTotal = document.getElementById('cart-total');
				cartItems.innerHTML = '';
				let total = 0;

				cart.forEach(product => {
					total += product.price * product.quantity;
					const li = document.createElement('li');
					li.textContent = `${product.name} - ${product.quantity} x $${product.price}`;
					cartItems.appendChild(li);
				});

				cartTotal.textContent = `Total: $${total.toFixed(2)}`;
			}

			// Función para crear una orden
			function createOrder() {
				if (cart.length === 0) {
					alert('El carrito está vacío.');
					return;
				}

				const orderData = {
					products: cart,
					total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
				};

				console.log(orderData);

				fetch('/orders', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json'
						},
						body: JSON.stringify(orderData)
					})
					.then(response => response.json())
					.then(data => {
						alert('Orden creada exitosamente');
						cart = [];
						updateCartView();
					})
					.catch(error => {
						console.error('Error al crear la orden:', error);
					});
			}
		</script>
</body>