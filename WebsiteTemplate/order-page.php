<?php
$active = 'order';
$currentpage = 'home';
include 'header.php';
include './template/nav.php';
?>
<!-- <link rel="stylesheet" href="./css/date-picker.css"> -->
<main class="account-page order-page">
	<div class="section-rule">
		<div class="row">
			<aside class="col-12 col-md-3">
				<?php include './template/profile-menu.php' ?>
			</aside>
			<aside class="col-12 col-md-9 ">
				<div class="card details">
					<h1 class="card-title">Total Order: <span>4</span></h1>
					<div class="card-panel">
						<ul>
							<li>
								<h3 class="card-title">Order Id: <span>DABAI20104</span></h3><span class="date">2 month ago</span>
							</li>
							<li>
								<h3 class="card-title">Pay Mode: <span>Khalti</span></h3><span class="price">Total RS 425</span>
							</li>
							<li>
								<h3 class="card-title">Order Status: <span class="sucess">Delivered</span></h3>
							</li>
							<div class="accordion">
								<li class="mb-0">
									<a  data-toggle="collapse" href="#order1" >
										<h3 class="card-title">View Order Details</h3>
										<i class="fas fa-chevron-down"></i>
									</a>
								</li>
								<div id="order1" class="collapse"  >
									
									<li >
										<h3 class="card-title">Ankle Grip <span>X2</span></h3>
										<span>Rs 350 X 2</span>
									</li>
									
								</div>
							</div>
						</ul>
					</div>

					<div class="card-panel">
						<ul>
							<li>
								<h3 class="card-title">Order Id: <span>DABAI20104</span></h3><span class="date">2 days ago</span>
							</li>
							<li>
								<h3 class="card-title">Pay Mode: <span>Khalti</span></h3><span class="price">Total RS 425</span>
							</li>
							<li>
								<h3 class="card-title">Order Status: <span class="pending">On a way</span></h3>
							</li>
							<div class="accordion">
								<li class="mb-0">
									<a  data-toggle="collapse" href="#order2" >
										<h3 class="card-title">View Order Details</h3>
										<i class="fas fa-chevron-down"></i>
									</a>
								</li>
								<div id="order2" class="collapse"  >
									
									<li >
										<h3 class="card-title">Ankle Grip <span>X2</span></h3><span>Rs 350 X 2</span>
									</li>
									<li >
										<h3 class="card-title">Ankle Grip <span>X2</span></h3><span>Rs 350 X 2</span>
									</li>
									
								</div>
							</div>
						</ul>
					</div>
				</div>
				<!-- <div class="card details no">
					<h2 class="card-title">No Order</h2>
				</div> -->
			</aside>
		</div>
	</div>
</main>
<?php
include 'footer.php';
?>
<script type="text/javascript" src="./js/date-picker.js"></script>
<script type="text/javascript">
	$(document).ready(function(){


	})
</script>
</body>
</html>



