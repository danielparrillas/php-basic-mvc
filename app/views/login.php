<?php
$title = 'Login';
require_once __DIR__ . '/components/header.php';
?>

<body class="h-screen flex items-center justify-center">
	<main class="w-96">
		<h2>Login</h2>
		<form action="/login" method="POST">
			<input type="email" name="email" placeholder="Email" required>
			<input type="password" name="password" placeholder="Password" required>
			<button type="submit">Login</button>
		</form>

		<?php if (isset($error)): ?>
			<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
				<span class="font-medium">Error!</span> <?php echo $error; ?>
			</div>
		<?php endif; ?>
	</main>
</body>