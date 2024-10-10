<?php
$title = 'Dashboard';
require_once __DIR__ . '/components/header.php';
?>

<body>
	<header class="shadow-sm sticky top-0 bg-gray-50">
		<?php require_once __DIR__ . '/components/navbar.php'; ?>
	</header>
	<main class="h-screen flex items-center justify-center">
		<section class="w-96">
			<h2 class="text-center">Dashboard</h2>
			<p class="text-center">
				Welcome, <?php echo $_SESSION['user_email']; ?>
			</p>
			<p class="text-center">
				<a href="/logout" class="text-blue-500">Logout</a>
			</p>
		</section>
	</main>
</body>