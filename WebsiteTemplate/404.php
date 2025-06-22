<?php
$active = '404';
$currentpage = '404';
include 'header.php';
include './template/nav.php';
?>

<main class="page-404">
	<div class="section-rule">
		<div class="row">
			<aside class="col-12 col-sm-6">
				<h1>404</h1>
				<h2 class="section-title">This Page is Lost in Space</h2>
				<p class="description">
					You thought this mission to the moon would be a quick six month thing. Your neighbor offered to look after your dog. Your high school math teacher was impressed. He once said you wouldn’t amount to anything.You sure showed him. But now here you are, fifty feet from your spaceship with no way to get back. Your dog will be so sad. Your math teacher will be so smug. Pretty devastating.
				</p>
				<button onclick="window.location.href='./index.php'">Go To Home Page</button>
			</aside>
			<aside class="col-12 col-sm-6">
				<div class="card-img">
					<img src="./gallery/Astronaut-big.png" alt="404 page not found">
				</div>
			</aside>
		</div>
	</div>
</main>

<?php
include 'footer.php';
?>
</body>
</html>