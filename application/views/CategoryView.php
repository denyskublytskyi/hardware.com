<?php include_once ROOT . '/application/views/layout/header.php'; ?>
<div id='page-content'>
	<div id='menu'>
		<nav>
			<?php include_once ROOT . '/application/views/layout/menu.php'; ?>
		</nav>
		<div id='filter'>
			<?php include_once ROOT . '/application/views/layout/filters.php'; ?>
		</div>
	</div>
	<div id='content'>
		<?php include_once ROOT . '/application/views/layout/categoryContent.php'; ?>
	</div>
</div>

<?php
	include_once ROOT . '/application/views/layout/feedback.php';
	include_once ROOT . '/application/views/layout/login.php';
	include_once ROOT . '/application/views/layout/registration.php';
?>

<?php include_once ROOT . '/application/views/layout/footer.php'; ?>
