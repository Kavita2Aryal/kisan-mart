<?php
$currentpage = 'other';
include 'header.php';
include './template/nav.php';
?>

<main class="faq-page common-page">
	<section class="section-rule common__bread p-0">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="./index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">FAQ</li>
			</ol>
		</nav>
		
		<div class="card details">
			<?php $counter=1 ?>
			<ul class="nav flex-column accordion" id="accordion">
				<!-- only active at a time -->
				<li class="nav-item ">
					<a class="nav-link " data-toggle="collapse" href="#collapse_<?php echo($counter) ?>" href="#!"  data-parent="#accordion">
						<span>
							0<?php echo($counter) ?>. What is FarmforFmily
						</span>
						<i class="material-icons">
							keyboard_arrow_down
						</i>
					</a>
					<div class="collapse show" id="collapse_<?php echo($counter); $counter++ ?>"  data-parent="#accordion">
						<div class="wrapper">
							<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid voluptates veritatis commodi, suscipit fugiat ratione sapiente exercitationem quae, fuga ex non ducimus ab iure nesciunt autem qui placeat vel aspernatur.</p>
						</div>
					</div>
				</li>
				<li class="nav-item ">
					<a class="nav-link collapsed " data-toggle="collapse" href="#collapse_<?php echo($counter) ?>" href="#!"  data-parent="#accordion">
						<span>
							0<?php echo($counter) ?>. How do I order groceries?
						</span>
						<i class="material-icons">
							keyboard_arrow_down
						</i>
					</a>
					<div class="collapse " id="collapse_<?php echo($counter); $counter++ ?>"  data-parent="#accordion">
						<div class="wrapper">
							<p>It’s so easy!</p>
							<p>Using FarmforFamily, add your favorite items to the cart, choose a delivery location, and place your order.</p>
							<p>What are you waiting for? Start shopping now!</p>
						</div>
					</div>
				</li>
				<li class="nav-item ">
					<a class="nav-link collapsed" data-toggle="collapse" href="#collapse_<?php echo($counter) ?>" href="#!"  data-parent="#accordion">
						<span>
							0<?php echo($counter) ?>. Is my address in your coverage area?
						</span>
						<i class="material-icons">
							keyboard_arrow_down
						</i>
					</a>
					<div class="collapse" id="collapse_<?php echo($counter); $counter++ ?>"  data-parent="#accordion">
						<div class="wrapper">
							<p>Want to know if Farmforfamily delivers in your area?</p>
							<p>Open the online portal, choose a delivery address, you will get a pop-up if your area is not covered.</p>
						</div>
					</div>
				</li>
				<li class="nav-item ">
					<a class="nav-link collapsed " data-toggle="collapse" href="#collapse_<?php echo($counter) ?>" href="#!"  data-parent="#accordion">
						<span>
							0<?php echo($counter) ?>. Is there a minimum order amount?
						</span>
						<i class="material-icons">
							keyboard_arrow_down
						</i>
					</a>
					<div class="collapse " id="collapse_<?php echo($counter); $counter++ ?>"  data-parent="#accordion">
						<div class="wrapper">
							<div class="cd-faq-content" style="display: block;">
								<p>It's super simple! The price you see in the Farmforfamily app is the price you pay</p>
								<p>We partner with multiple stores, and each store might sell the same product at different prices. Since the market prices keep changing in the FMCG industry, there is a possibility of slight price differences, especially for fruits and vegetables.</p> 
								<p>We purchase products from supermarkets and the product price from various retailers can be different. The price paid in Farmforfamily can slightly vary from in store prices, as that includes the cost for packing and processing the product. The products are freshly picked from the super markets and not sourced from the warehouse.</p> 
								<p>We are trying hard to pick the latest market price, however, minute fluctuations may occur. Please feel free to contact us when you come across such price variations. We are more than happy to refund you the difference amount!</p>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>

	</section>

	<section class="customer">
		<div class="section-rule">
			<h2 class="section-title">
				Didn't Find What you looking for?
			</h2>
			<a href="tel:9825131071">Contact Customer Care</a>
		</div>
	</section>		
</main>

<?php
include 'footer.php';
?>
</body>
</html>
