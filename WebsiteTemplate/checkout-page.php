<?php
$currentpage = 'other';
include 'header.php';
include './template/nav.php';
?>
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<main class="category-page  common-page cart-page checkout">
	<section class="section-rule">
		
		<div class="row screen">
			<aside class="filter">
				<div class="sticky">
					<ul class="nav">
						<h2 class="section-title">Order Summery</h2>
						<hr>
						<div class="fresh-vegetables">
							<div class="card card__horizontal">
								<div class="card__img">
									<img src="./gallery/freshveg/Rectangle 17.jpg" alt="">
								</div>
								<div class="card__body">
									<h2 class="card_title"><a href="./single-page.php">Green Cabbage</a></h2>
									<div class="card__top">
										<div class="card_title--wrapper">
											<p class="price"><b>Rs. 35.00 </b>/Kg </p>
										</div>
										<div class="qty">
											<div class="form-group">
												<button class="dec">-</button>
												<input type="number" min="0" max="5" value="1" class="form-control" disabled="" id="qty">
												<button class="inc">+</button>
											</div>
										</div>
									</div>
									<a href="#!" class="remove"><i class="material-icons">close</i></a>
								</div>	
							</div>
							<div class="card card__horizontal">
								<div class="card__img">
									<img src="./gallery/freshveg/Rectangle 17-2.jpg" alt="">
								</div>
								<div class="card__body">
									<h2 class="card_title"><a href="./single-page.php">Fresh Green Corn</a></h2>
									<div class="card__top">
										<div class="card_title--wrapper">
											<p class="price"><b>Rs. 25.00 </b>/Kg</p>
											
										</div>
										<div class="qty">
											<div class="form-group">
												<button class="dec">-</button>
												<input type="number" min="0" max="5" value="1" class="form-control" disabled="" id="qty">
												<button class="inc">+</button>
											</div>
										</div>
									</div>
									<a href="#!" class="remove"><i class="material-icons">close</i></a>
								</div>	
							</div>
							<div class="card card__horizontal">
								<div class="card__img">
									<img src="./gallery/freshveg/Rectangle 17-4.jpg" alt="">
								</div>
								<div class="card__body">
									<h2 class="card_title"><a href="./single-page.php">Bitter Gourd(Karela)</a></h2>
									<div class="card__top">
										<div class="card_title--wrapper">
											<p class="price"><b>Rs. 40.00 </b>/Kg</p>
											
										</div>
										<div class="qty">
											<div class="form-group">
												<button class="dec">-</button>
												<input type="number" min="0" max="5" value="1" class="form-control" disabled="" id="qty">
												<button class="inc">+</button>
											</div>
										</div>
									</div>
									<a href="#!" class="remove"><i class="material-icons">close</i></a>
								</div>	
							</div>
						</div>

						<hr class="dotted">
						<li class="nav-link">Sub Total <span>Rs 1,850</span>
						</li>
						<li class="nav-link">Delivery Fee <span>Rs 50</span></li>
						<hr class="dotted">
						<li class="nav-link total">Total Amount <span>Rs 1,900</span>
						</li>
						
						
						
					</ul>
					<p>
						<label>Delivery in today 2 to 3 hr</label>
					</p>
					

				</div>
			</aside>

			<!-- card -->
			<aside class="pr-0 ">
				<div class="account mb-5">
					<h2 class="section-title ">Shiping Details</h2>
					<div class="row">
						<div class="col-sm-6 pl-0">
							<article class="card default ">
								<ul>
									<li><p>Nhk Misaki</p></li>
									<li><p>1234 56 Maharanj</p></li>
									<li><p>Kathmandu, 44600</p></li>
									<li><p>9825131071</p></li>
								</ul>

							</article>
						</div>
						<div class="col-sm-6">
							<a href="#!" class="card " data-toggle="modal" data-target="#newadd">
								<span class="material-icons">
									add_circle_outline
								</span>
								<p>Ship to new address</p>
							</a>
						</div>
						<div class="modal fade login-form" id="newadd" tabindex="-1" role="dialog" >
							<div class="modal-dialog modal-dialog-centered ">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">New Shipping address</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span class="material-icons">close</span>
										</button>
									</div>


									<div class="modal-body">
										<form action="./account-page.php" class="form">
											<div class="form-group">
												<input type="text" placeholder="Full Address" class="form-control">
											</div>
											<div class="form-group">

												<input type="text" placeholder="City" class="form-control">
											</div>
											<div class="form-group">
												<button type="submit"> Upadted Address</button>
											</div>
										</form>
									</div>


								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="payment ">
					<h2 class="section-title">Payment Method</h2>

					<div class="form-row ">
						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="materialUnchecked" name="materialExampleRadios">
							<label class="custom-control-label" for="materialUnchecked">Cash on delivery</label>
						</div>

						<div class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" id="materialChecked" name="materialExampleRadios">
							<label class="custom-control-label" for="materialChecked"><img src="./gallery/esewa_logo.png" alt=""></label>
						</div>
						<div class="custom-control custom-radio " id="payment-button">
							<input type="radio" class="custom-control-input" id="kalti" name="materialExampleRadios">
							<label class="custom-control-label" for="kalti"><img src="./gallery/Khalti.png" alt=""></label>
						</div>
					</div>
				</div>

				<div class="mob-input">
					<button onclick="window.location.href=''">
						Place Order
					</button>
				</div>
			</aside>	
		</div>
	</section>

</main>



<?php
include 'footer.php';
?>
<script>
	let checkAmount = $('.nav-link.total span').text(). 
	var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "amount": 130000,
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
            ],
            "eventHandler": {
            	onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                	console.log(error);
                },
                onClose () {
                	console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 130000});
        }
    </script>
    <script>
    	$(document).ready(function(){
    		if($(this).prop("checked") == true){
    			$('.payment .custom-control').removeClass('active');
    			$(this).parent().addClass('active')
    		}
    		$('.payment .custom-control input').click(function(){
    			if($(this).prop("checked") == true){
    				$('.payment .custom-control').removeClass('active');
    				$(this).parent().addClass('active')
    			}
    		})
    	})
    </script>

</body>
</html>

