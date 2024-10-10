<?php
$title = 'Dashboard';
require_once __DIR__ . '/components/header.php';
?>

<body>
	<?php require_once __DIR__ . '/components/navbar.php'; ?>
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