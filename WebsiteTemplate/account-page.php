<?php
$currentpage = 'other';
$slider = 'slider';
include 'header.php';
include './template/accnav.php';
?>

<main class="common-page account-page">
	<section class="section-rule">
		<div class="row screen">
			<aside class="filter">
				<div class="sticky">
					<ul  role="tablist" class="nav  list-group ">
						<li><h2 class="section-title">Hi, Nhk misaki</h2></li>
						<li>
							<a class="nav-link active" data-toggle="pill" href="#order-tab" role="tab">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
									<path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
								</svg>
							Order</a>
						</li>
						<li>
							<a class="nav-link" data-toggle="pill" href="#package-tab" role="tab">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-ui-checks-grid" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M2 10a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H2zm9-9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-3zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854l-2 2a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708L3 3.793l1.646-1.647a.5.5 0 1 1 .708.708z"/>
								</svg>
								Package
							</a>
						</li>
						
						
						
						<li>
							<a class="nav-link" data-toggle="pill" href="#noti-tab" role="tab">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
									<path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
								</svg>
								Notification
							</a>
						</li>

						<li>
							<a class="nav-link "  data-toggle="pill" href="#personal-tab" role="tab">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
								</svg>
							Account</a>
						</li>

						
						<li>
							<a class="nav-link" data-toggle="pill" href="#changepass-tab" role="tab">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
									<path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>
							Change Password</a>
						</li>
						<li>
							<a href="#"  class="nav-link log-out">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
									<path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
								</svg>
							Log out</a>
						</li>
					</ul>
				</div>
			</aside>
			<aside class="pr-0  tab-content">
				<div class="tab-pane fade row m-0 order-tab show active" id="order-tab" role="tabpanel">
					<h2 class="section-title">My Orders</h2>
					
					<table class="table  table-responsive  table-borderless">
						<thead>
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Order ID</th>
								<th scope="col">Total Products</th>
								<th scope="col">Total Price </th>
								<th scope="col">Status</th>
								<th scope="col"></th>

							</tr>
						</thead>
						<tbody>
							<tr>
								<td >04/08/2020</td>
								<td>FFF101</td>
								<td>5</td>
								<td>Rs 1,000</td>
								<td><label for="" class="bg-info status">On a way</label></td>
								<td><a href="#" data-toggle="modal" data-target="#order__details">View details</a></td>
							</tr>
							<tr>
								<td >04/07/2020</td>
								<td>FFF100</td>
								<td>2</td>
								<td>Rs 100</td>
								<td><label for="" class="bg-success status">Delivered</label></td>
								<td><a href="#" data-toggle="modal" data-target="#order__details">View details</a></td>
							</tr>
							<tr>
								<td >01/07/2020</td>
								<td>FFF099</td>
								<td>4</td>
								<td>Rs 312</td>
								<td><label for="" class="bg-danger status">Cancel</label></td>
								<td><a href="#" data-toggle="modal" data-target="#order__details">View details</a></td>
							</tr>
						</tbody>
					</table>

					<div class="modal fade " id="order__details">
						<div class="modal-dialog modal-dialog-centered ">
							<div class="modal-content">
								<div class="modal-header border-0 pb-0">
									<h2 class="section-title">Order Details</h2>

									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span class="material-icons">close</span>
									</button>
								</div>

								<div class="modal-body">

									<ul class="nav">
										<li class="nav-link">Date: <span>04/08/2020</span>
										</li>
										<li class="nav-link">Order Id: <span>FFF101</span>
										</li>
										
										<li class="nav-link">Status: <span class="bg-info status">On a way</span>
										</li>
									</ul>
									<table class="table  table-responsive-sm  table-borderless">
										<thead>
											<tr>
												<th scope="col">S.N</th>
												<th scope="col">Name</th>
												<th scope="col">Price</th>
												<th scope="col">Qty </th>
												<th scope="col">Total price</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td><a href="./single-page.php">Green Cabbage</a></td>
												<td>35.00/ kg</td>
												<td>2</td>
												<td>Rs 70</td>
											</tr>
											<tr>
												<td>2</td>
												<td><a href="./single-page.php">Fresh Green Corn</a></td>
												<td>25.00/ kg</td>
												<td>3</td>
												<td>Rs 75</td>
											</tr>
											<tr>
												<td>3</td>
												<td><a href="./single-page.php">Bitter Gourd(Karela)</a></td>
												<td>40.00/ kg</td>
												<td>1</td>
												<td>Rs 40</td>
											</tr>
											<tr>
												<td>4</td>
												<td><a href="./single-page.php">Green Peas (Matar)</a></td>
												<td>25.00/ kg</td>
												<td>1</td>
												<td>Rs 25 </td>
											</tr>
											<tr>
												<td>5</td>
												<td><a href="./single-page.php">Green Chilli</a></td>
												<td>40.00/ kg</td>
												<td>2</td>
												<td>Rs 80</td>
											</tr>
											<tfoot>
												<td colspan="2">Sub total: Rs 290</td>
												<td>Delivery fee: 50</td>
												<td colspan="2">Total: <b>Rs 310</b> </td>
												
											</tfoot>

										</tbody>
									</table>
								</div>

								<!-- you dont need to add it, if there is no need for button -->
								<div class="modal-footer">
									<button onclick="window.location.href=''" class="del">
										Cancel order
									</button>
									<button onclick="window.location.href=''">
										Track my order
									</button>

								</div>

							</div>
						</div>
					</div>

					<div class="empty">
						<span class="material-icons">
							remove_shopping_cart
						</span>
						<h2 class="card__title">Looks like you haven't made any orders yet
						Once you make a booking, all the details will appear here.</h2>
					</div>
					

				</div>
				<div class="tab-pane fade row m-0 package" id="package-tab" role="tabpanel">

					<h2 class="section-title">My Package (2)</h2>
					
					
					<table class="table  table-responsive  table-borderless">
						<thead>
							<tr>
								<th scope="col">Last edited</th>
								<th scope="col">Name</th>
								<th scope="col">Total Products</th>
								<th scope="col">Total Price </th>
								<th scope="col">Action</th>
								<th></th>

							</tr>
						</thead>
						<tbody>
							<tr>
								<td >04/08/2020</td>
								<td>Weekly veg</td>
								<td>5</td>
								<td>Rs 1,000</td>
								<td><button onclick="window.location.href='./checkout-page.php'">Order Now</button></td>
								<td><a href="#" data-toggle="modal" data-target="#package-edit01">Edit</a></td>
							</tr>
							<tr>
								<td >04/07/2020</td>
								<td>Weekly Fruits</td>
								<td>2</td>
								<td>Rs 400</td>
								<td><button onclick="window.location.href='./checkout-page.php'">Order Now</button></td>
								<td><a href="#" data-toggle="modal" data-target="#package-edit01">Edit</a></td>
							</tr>
						</tbody>
					</table>

					<div class="card__action">
						<button   data-toggle="collapse" data-target="#new__package">
							Create Package
						</button>
						<div class="collapse" id="new__package">
							<div class="card card-body">
								<form action="">	
									<div class="form">
										<div class="form-group">
											<label for="pk_name">Package Name</label>
											<input type="text" class="form-control" id="pk_name">
										</div>
										<button type="submit">Add Package</button>
									</div>
								</form>

							</div>
						</div>
					</div>

					<!-- modal -->
					<div class="modal fade login-form" id="package-edit01">
						<div class="modal-dialog modal-dialog-centered ">
							<div class="modal-content">
								<div class="modal-header border-0 pb-0">
									<div class="form-group">
										<input type="text" class="form-control" value="Weekely Veg">
									</div>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span class="material-icons">close</span>
									</button>
								</div>

								<div class="modal-body">

									<ul class="nav">
										<li class="nav-link">Last edited: <span>04/08/2020</span>
										</li>
										<li class="nav-link">Total products: <span>5</span>
										</li>
										<li class="nav-link">Total price: <span>Rs 310</span>
										</li>

										<li class="nav-link"><button onclick="window.location.href='#!'">Order Now</button></span>
										</li>
									</ul>
									<table class="table  table-responsive-sm  table-borderless">
										<thead>
											<tr>
												<th scope="col">S.N</th>
												<th scope="col">Name</th>
												<th scope="col">Price</th>
												<th scope="col">Qty </th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td><a href="./single-page.php">Green Cabbage</a></td>
												<td>35.00/ kg</td>
												<td>
													<div class="qty">
														<div class="form-group">
															<button class="dec">-</button>
															<input type="number" min="0" max="5" value="2" class="form-control" disabled="" id="qty">
															<button class="inc">+</button>
														</div>
													</div>
												</td>
												<td><a href="#!" class="remove"><label>Remove</label></a></td>
											</tr>
											<tr>
												<td>2</td>
												<td><a href="./single-page.php">Fresh Green Corn</a></td>
												<td>25.00/ kg</td>
												<td>
													<div class="qty">
														<div class="form-group">
															<button class="dec">-</button>
															<input type="number" min="0" max="5" value="3" class="form-control" disabled="" id="qty">
															<button class="inc">+</button>
														</div>
													</div>
												</td>
												<td><a href="#!" class="remove"><label>Remove</label></a></td>
											</tr>
											<tr>
												<td>3</td>
												<td><a href="./single-page.php">Bitter Gourd(Karela)</a></td>
												<td>40.00/ kg</td>
												<td>
													<div class="qty">
														<div class="form-group">
															<button class="dec">-</button>
															<input type="number" min="0" max="5" value="1" class="form-control" disabled="" id="qty">
															<button class="inc">+</button>
														</div>
													</div>
												</td>
												<td><a href="#!" class="remove"><label>Remove</label></a></td>
											</tr>
											<tr>
												<td>4</td>
												<td><a href="./single-page.php">Green Peas (Matar)</a></td>
												<td>25.00/ kg</td>
												<td>
													<div class="qty">
														<div class="form-group">
															<button class="dec">-</button>
															<input type="number" min="0" max="5" value="1" class="form-control" disabled="" id="qty">
															<button class="inc">+</button>
														</div>
													</div>
												</td>
												<td><a href="#!" class="remove"><label>Remove</label></a></td>
											</tr>
											<tr>
												<td>5</td>
												<td><a href="./single-page.php">Green Chilli</a></td>
												<td>40.00/ kg</td>
												<td>
													<div class="qty">
														<div class="form-group">
															<button class="dec">-</button>
															<input type="number" min="0" max="5" value="2" class="form-control" disabled="" id="qty">
															<button class="inc">+</button>
														</div>
													</div>
												</td>
												<td><a href="#!" class="remove"><label>Remove</label></a></td>
											</tr>
											<tfoot>
												<td colspan="2">Sub total: Rs 290</td>
												<td colspan="2">Delivery fee: 50</td>
												<td >Total: <b>Rs 310</b> </td>

											</tfoot>

										</tbody>
									</table>
								</div>

								<!-- you dont need to add it, if there is no need for button -->
								<div class="modal-footer">
									<button onclick="window.location.href=''" class="del">
										Delete Package
									</button>
									<button onclick="window.location.href=''">
										Update Package
									</button>

								</div>

							</div>
						</div>
					</div>

					<div class="empty">
						<span class="material-icons">
							grid_off
						</span>
						<h2 class="card__title">Looks like you haven't made any Packages yet.
							Select Your Product to add packages <a href="./category-page.php" class="d-inline">Here</a>
						</h2>
					</div>

				</div>
				<div class="tab-pane fade row m-0 noti-tab" id="noti-tab" role="tabpanel">
					<h2 class="section-title">Notifications</h2>
					<ul class="list-group">
						<li class="list-group-item" aria-disabled="true">
							<p>Your products have been successfully delivered</p>
							<time>Recently</time>

						</li>
						<li class="list-group-item"><p>Package has been successfully updated </p>
							<time>4 days ago</time>
						</li>
						<li class="list-group-item">
							<p>Your products have been successfully delivered</p>
							<time>3 days ago</time>
						</li>
						<li class="list-group-item">
							<p>password has been successfully updated.</p>
							<time>3 days ago</time>
						</li>
						<li class="list-group-item">
							<p>Your products have been successfully delivered</p>
							<time>3 days ago</time>
						</li>
					</ul>

				</div>
				<div class="tab-pane fade  account m-0" id="personal-tab" role="tabpanel">
					<h2 class="section-title">My Account</h2>

					<form >
						<div class="form-row">
							<div class="form-group col-12 ">
								<label for="name">Full Name</label>
								<input type="text" class="form-control" id="name" value="Natsuki Horikita" placeholder="Full Name">
							</div>
							<!-- phone -->
							<div class="form-group number col-12 col-md-6">
								<label for="email">Phone Number</label>

								<input type="tel" class="form-control" value="+9779825131071" placeholder="Phone Number" >
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="email">Email Address</label>
								<input type="email" class="form-control" value="nhkmisaki@gmail.com" placeholder="Email Address" id="email">
							</div>

						</div>
						<button  type="submit col-12 " type="submit">
							Changed Save
						</button>
					</form>

					<h2 class="section-title mt-4">Delivery Address</h2>
					<div class="row">
						<div class="col-sm-6">
							<article class="card default">
								<ul>
									<li><p>Nhk Misaki</p></li>
									<li><p>1234 56 Maharanj</p></li>
									<li><p>Kathmandu, 44600</p></li>
									<li><p>9825131071</p></li>
								</ul>
								<a href="#!" class="remove"><i class="material-icons">close</i><label>Remove</label></a>
							</article>
						</div>
						<div class="col-sm-6">
							<a href="#!" class="card " data-toggle="modal" data-target="#newadd">
								<span class="material-icons">
									add_circle_outline
								</span>
								<p>Add new address</p>
							</a>
						</div>
						<div class="modal fade login-form" id="newadd" tabindex="-1" role="dialog" >
							<div class="modal-dialog modal-dialog-centered ">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Add new address</h5>
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
												<button type="submit"> Add Address</button>
											</div>
										</form>
									</div>


								</div>
							</div>
						</div>
					</div>

				</div>


				<div class="tab-pane fade row m-0 account" id="changepass-tab" role="tabpanel">
					<h2 class="section-title">My Account</h2>

					<form >
						<div class="form-row">
							<div class="form-group col-12 ">
								<label for="oldpp">Old Password</label>
								<input type="password" class="form-control" id="oldpp">
							</div>
							<!-- phone -->
							<div class="form-group number col-12">
								<label for="Newpp">New Password</label>
								<input type="password" class="form-control" id="Newpp">
							</div>

							<p><a href="#!">Forget password?</a></p>


						</div>
						<button  type="submit col-12 " type="submit">
							Changed Save
						</button>
					</form>
				</div>
			</aside>	
		</div>
	</section>
</main>





<?php
include 'footer.php';
?>


</body>
</html>
