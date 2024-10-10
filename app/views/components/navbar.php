<?php
session_start();
$isLogged =  isset($_SESSION['user_id']);
?>

<nav class="container mx-auto px-6 py-3">
	<div class="flex w-full justify-between">
		<div class="text-xl font-bold text-gray-800">IGF</div>
		<div class="hidden md:flex space-x-6">
			<a href="/" class="text-gray-600 hover:text-gray-900 no-underline">Home</a>
			<a href="/productos" class="text-gray-600 hover:text-gray-900 no-underline">Productos</a>
			<?php if ($isLogged) : ?>
				<a href="/dashboard" class="text-gray-600 hover:text-gray-900 no-underline">Dashboard</a>
			<?php else : ?>
				<a href="/login" class="text-gray-600 hover:text-gray-900 no-underline">Login</a>
			<?php endif; ?>
			<?php if ($isLogged) : ?>
				<a href="/logout" class="text-gray-600 hover:text-gray-900 no-underline">Logout</a>
			<?php endif; ?>
		</div>
		<div class="md:hidden">
			<div class="w-full flex justify-end">
				<button id="menu-toggle" class="p-1">
					<svg class="size-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
					</svg>
				</button>
			</div>
			<div id="mobile-menu" class="hidden mt-4 md:hidden ">
				<a href="/" class="block py-2 text-gray-600 hover:text-gray-900 no-underline">Home</a>
				<a href="/products" class="block py-2 text-gray-600 hover:text-gray-900 no-underline">Productos</a>
				<?php if ($isLogged) : ?>
					<a href="/dashboard" class="block py-2 text-gray-600 hover:text-gray-900 no-underline">Dashboard</a>
				<?php else : ?>
					<a href="/login" class="block py-2 text-gray-600 hover:text-gray-900 no-underline">Login</a>
				<?php endif; ?>
				<?php if ($isLogged) : ?>
					<a href="/logout" class="block py-2 text-gray-600 hover:text-gray-900 no-underline">Logout</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>