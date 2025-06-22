<?php
$currentpage = 'other';
include 'header.php';
include './template/nav.php';
?>

<main class="single-page common-page login-form">
	<section class="section-rule pb-0">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<div class="logo">
						<img src="./gallery/logo.png" alt="">
					</div>
				</div>
				<h5 class="modal-title" id="staticBackdropLabel">Create Your Account</h5>

				<div class="modal-body">
					<form action="./account-page.php" class="form">
						<div class="form-group">
							<input type="email" placeholder="Email" class="form-control" id="email">
						</div>
						<div class="form-group">

							<input type="password" placeholder="Password" class="form-control" id="pass">
						</div>
						<div class="form-group">
							<button type="submit">Create Account</button>
						</div>

					</form>
					<span>Or</span>
					<div class="d-flex">
						<button class="facebook">signup with <i class="fab fa-facebook-f"></i></button>
						<button class="google">signup with <i class="fab fa-google-plus-g" aria-hidden="true"></i></button>
					</div>
					<p class="mb-0">Already have an account? <a href="#!" data-toggle="modal" data-target="#login">Sign In</a>.</p>

				</div>
			</div>
		</div>
	</section>
</main>
<?php
include 'footer.php';
?>
</body>
</html>
