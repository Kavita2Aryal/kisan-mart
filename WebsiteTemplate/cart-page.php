<?php
$currentpage = 'other';
include 'header.php';
include './template/nav.php';
?>

<main class="category-page  common-page cart-page">
	<section class="section-rule">
		
		<div class="row screen">
			<aside class="filter">
				<div class="sticky">
					<ul class="nav">
						<h2 class="section-title">Price Details</h2>
						<hr>
						<li class="nav-link">price(5 Items) <span>Rs 1,850</span>
						</li>
						<li class="nav-link">Delivery Fee <span>Rs 50</span></li>
						<hr class="dotted">
						<li class="nav-link total">Total Amount <span>Rs 1,900</span>
						</li>
						<hr class="dotted">
						<div class="mob-input">
							<button onclick="window.location.href='./checkout-page.php'">
								Place Order
							</button>
						</div>
						
						<label>You will save Rs.80 on this order</label>
					</ul>
					<p>
						<span class="material-icons-outlined">
							verified_user
						</span>
						<label>Safe and Secure Payment</label>
					</p>

				</div>
			</aside>

			<!-- card -->
			<aside class="pr-0">
				<div class="title-wrapper">
					<div class="title__part">
						<h2 class="section-title">My Cart <small>(5 Items)</small></h2>
					</div>
				</div>	
				<?php 

				include './template/card-horizontal.php';
				?>


				

				
			</aside>	
		</div>
	</section>

</main>



<?php
include 'footer.php';
?>

</body>
</html>
