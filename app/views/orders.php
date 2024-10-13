<?php
$title = 'Ordenes';
require_once __DIR__ . '/components/header.php';
?>

<body class="bg-gray-950/70 min-h-screen">
	<?php require_once __DIR__ . '/components/navbar.php'; ?>
	<main class="h-full flex flex-col">
		<section class="p-4">
			<div class="flex justify-between gap-4 mb-4">
				<h2 class="my-2">Ordenes</h2>
			</div>
			<table id="products-table">
				<thead>
					<tr>
						<th class="rounded-tl-md bg-gray-500/20">Fecha</th>
						<th class="bg-gray-500/20">Estado</th>
						<th class="bg-gray-500/20">Total</th>
						<th class="rounded-tr-md bg-gray-500/20">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($orders as $order) : ?>
						<tr>
							<td><?= $order['created_at'] ?></td>
							<td>
								<?php switch ($order['status']):
									case 'completed': ?>
										<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completada</span>
										<?php break; ?>
									<?php
									case 'pending': ?>
										<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pendiente</span>
										<?php break; ?>
									<?php
									case 'canceled': ?>
										<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Cancelada</span>
										<?php break; ?>
								<?php endswitch; ?>
							</td>
							<td>$<?= $order['total'] ?></td>
							<td>
								<?php if ($order['status'] === 'pending') : ?>
									<form action="/orders" method="POST">
										<input type="hidden" name="_method" value="DELETE">
										<input type="hidden" name="order_id" value="<?= $order['id'] ?>">
										<button type="submit" class="bg-red-500 text-white px-2 py-1 rounded border-none">Eliminar</button>
									</form>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	</main>