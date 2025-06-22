<?php
$currentpage = 'home';
include 'header.php';
include './template/nav.php';
?>

<main class="home-page">
	<?php 
	include './template/screen.php';
	include './template/today-stock.php';
	?>
	<section class="banner">
		<div class="section-rule">
			<div class="row">
				<a href="./single-page.php" class="col-6">
					<img src="./gallery/banner03.jpg" alt="">
				</a>
				<a href="./single-page.php" class="col-6">
					<img src="./gallery/banner04.jpg" alt="">
				</a>
			</div>
		</div>
	</section>
	
	<!-- fresh vegetables -->
	<?php 
	include './template/fresh-vegetables.php';
	?>
	
	<!-- banner -->
	<section class="banner">
		<div class="section-rule">
			<a href="./single-page.php">
				<img src="./gallery/banner05.jpg" alt="">
			</a>
		</div>
	</section>

	<!-- Sweet Fruits -->
	<?php 
	include './template/sweet-fruits.php';
	?>

	
	<!--  -->
</main>

<?php
include 'footer.php';
?>
<!-- custom -->
<script type="text/javascript" src="./js/custom.js"></script>

</body>
</html>
