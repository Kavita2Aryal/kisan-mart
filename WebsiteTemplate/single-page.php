<?php
$currentpage = 'other';
include 'header.php';
include './template/nav.php';
?>

<main class="single-page common-page">
	<section class="section-rule products common__bread p-0">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="./index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="./category-page.php">Green Vegetable</a></li>
				<li class="breadcrumb-item active" aria-current="page">Green Cabbage( Banda Kobi)</li>
			</ol>
		</nav>


		<div class="row card__wrapper">
			<aside class="col-12 col-lg-6 ">
				<div class="sticky">
					<div class="slider-for">
						<div class="item">
							<div class="card-image">
								<a data-fancybox="gallery" href="./gallery/single/Rectangle 17.jpg">
									<img src="./gallery/single/Rectangle 17.jpg" alt="" title="View Full Size">
								</a>
							</div>
						</div>
						<div class="item">
							<div class="card-image">
								<a data-fancybox="gallery" href="./gallery/single/Rectangle 53.png">
									<img src="./gallery/single/Rectangle 53.png" alt="" title="View Full Size">
								</a>
							</div>
						</div>
						<div class="item">
							<div class="card-image">
								<a data-fancybox="gallery" href="./gallery/single/Rectangle 59.png">
									<img src="./gallery/single/Rectangle 59.png" alt="" title="View Full Size">
								</a>
							</div>
						</div>
						<div class="item">
							<div class="card-image">
								<a data-fancybox="gallery" href="./gallery/single/Rectangle 60.png">
									<img src="./gallery/single/Rectangle 60.png" alt="" title="View Full Size">
								</a>
							</div>
						</div>
						<div class="item">
							<div class="card-image">
								<a data-fancybox="gallery" href="./gallery/single/Rectangle 61.png">
									<img src="./gallery/single/Rectangle 61.png" alt="" title="View Full Size">
								</a>
							</div>
						</div>
						<div class="item">
							<div class="card-image">
								<a data-fancybox="gallery" href="./gallery/single/Rectangle 62.png">
									<img src="./gallery/single/Rectangle 62.png" alt="" title="View Full Size">
								</a>
							</div>
						</div>
					</div>

					<div class="slider-nav">
						<!-- must be same image from above -->
						<div class="item">
							<div class="card-image">
								<img src="./gallery/single/Rectangle 17.jpg" alt="">
							</div>
						</div>	
						<div class="item">
							<div class="card-image">
								<img src="./gallery/single/Rectangle 53.png" alt="">
							</div>
						</div>	
						<div class="item">
							<div class="card-image">
								<img src="./gallery/single/Rectangle 59.png" alt="">
							</div>
						</div>	
						<div class="item">
							<div class="card-image">
								<img src="./gallery/single/Rectangle 60.png" alt="">
							</div>
						</div>	
						<div class="item">
							<div class="card-image">
								<img src="./gallery/single/Rectangle 61.png" alt="">
							</div>
						</div>
						<div class="item">
							<div class="card-image">
								<img src="./gallery/single/Rectangle 62.png" alt="">
							</div>
						</div>		
					</div>
					
				</div>
			</aside>
			<aside class="col-12 col-lg-6 card__body">
				<div class="title__wrapper d-flex">
					<div class="">
						<h1 class="card__title">Green Cabbage (Banda Kobi)</h1>
						<p class="stock">
							<svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.83 31C14.7205 31 14.6201 31 14.5106 30.9909C12.8316 30.8814 11.335 29.9323 10.5229 28.4632C10.0849 27.6693 9.18145 27.2221 8.28718 27.3681C6.61725 27.6236 4.96558 27.0214 3.84317 25.753C2.72988 24.4845 2.34662 22.7599 2.81201 21.1447C3.06752 20.2687 2.73901 19.3196 2.00899 18.7904C0.649319 17.7775 -0.098954 16.1805 0.0105493 14.5015C0.120053 12.8224 1.06908 11.3259 2.53825 10.5137C3.33215 10.0757 3.77929 9.17233 3.63329 8.27805C3.37778 6.60813 3.98005 4.95645 5.23933 3.84317C6.50775 2.72988 8.23243 2.34662 9.8476 2.81201C10.7236 3.06752 11.6727 2.73901 12.2019 2.00899C13.1966 0.649319 14.8026 -0.098954 16.4817 0.0105493C18.1607 0.120053 19.6573 1.06908 20.4694 2.53825C20.9074 3.33215 21.8108 3.77929 22.7051 3.63329C24.375 3.37778 26.0267 3.98005 27.1491 5.24846C28.2624 6.51687 28.6457 8.24155 28.1803 9.85673C27.9248 10.7328 28.2533 11.6818 28.9833 12.211C30.343 13.2057 31.0912 14.8026 30.9817 16.4908C30.8722 18.1699 29.9232 19.6664 28.454 20.4786C27.6601 20.9166 27.213 21.82 27.359 22.7142C27.6145 24.3842 27.0122 26.0358 25.7438 27.1583C24.4754 28.2807 22.7507 28.6548 21.1356 28.1894C20.2595 27.9339 19.3105 28.2624 18.7812 28.9924C17.8505 30.2609 16.3904 31 14.83 31ZM8.60656 24.5941C10.3769 24.5941 12.0468 25.5522 12.9137 27.14C13.2787 27.8062 13.9175 28.2077 14.6749 28.2624C15.4323 28.308 16.1167 27.9887 16.5638 27.3773C17.7775 25.7165 19.9219 24.9864 21.893 25.5613C22.623 25.7712 23.3621 25.607 23.937 25.1051C24.5119 24.6032 24.7674 23.8914 24.6488 23.1431C24.3385 21.1082 25.3332 19.0824 27.1309 18.0877C27.797 17.7227 28.1985 17.0839 28.2533 16.3265C28.2989 15.5692 27.9795 14.8848 27.3681 14.4376C25.7073 13.224 24.9773 11.0795 25.5522 9.10845C25.7621 8.37843 25.5978 7.63928 25.0959 7.06439C24.594 6.49862 23.8823 6.23399 23.134 6.35262C21.0991 6.66288 19.0733 5.66822 18.0786 3.87054C17.7136 3.2044 17.0657 2.80289 16.3174 2.74813C15.56 2.70251 14.8756 3.02189 14.4285 3.63329C13.2148 5.29409 11.0704 6.02411 9.09933 5.44922C8.3693 5.23933 7.63016 5.40359 7.05526 5.90548C6.4895 6.40737 6.22486 7.11914 6.34349 7.86742C6.65375 9.90235 5.6591 11.9282 3.86142 12.9228C3.19527 13.2878 2.79376 13.9357 2.73901 14.684C2.69338 15.4414 3.01277 16.1258 3.62416 16.5729C5.28496 17.7866 6.01498 19.931 5.44009 21.9021C5.23021 22.6321 5.39446 23.3713 5.89635 23.9462C6.39824 24.5211 7.11002 24.7766 7.85829 24.6579C8.1138 24.6123 8.36018 24.5941 8.60656 24.5941Z" fill="#269116"  />
								<path d="M14.3007 20.3782L9.61938 15.706L11.5539 13.7715L14.3007 16.5091L19.4473 11.3624L21.3819 13.297L14.3007 20.3782Z" fill="#269116"/>
							</svg>
							<span>In Stock</span> 
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="0.5" y="0.5" width="15" height="15" fill="white" stroke="#269116"/>
								<circle cx="8.00006" cy="8" r="4.26667" fill="#269116"/>
							</svg>
						</p>
					</div>
					
					<div class="share">
						<button class="share">
							<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"/></svg>
						</button>
						<button onclick="" class="wishlist">
							<svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M25.3551 15.6373C24.3059 17.1788 23.0819 18.5491 21.8578 19.9194C20.6338 21.2897 19.4098 22.4887 18.0109 23.6877C17.3114 24.3728 16.612 24.8866 16.2622 25.2292C15.0382 26.2569 13.1147 26.2569 11.7158 25.2292C11.3661 24.8866 10.6666 24.3728 9.96718 23.6877C8.74314 22.3174 7.34424 21.1184 6.1202 19.7481C4.89616 18.3778 3.67212 17.0076 2.62294 15.6373C1.04918 13.5819 0.174863 11.1839 0 8.61461C0 6.38791 0.874314 4.16121 2.44808 2.44836C5.59561 -0.463476 10.6666 -0.806045 13.989 1.93451C17.3114 -0.806045 22.3824 -0.634761 25.53 2.44836C27.2786 4.16121 28.1529 6.38791 27.978 8.61461C27.8032 11.1839 26.9289 13.5819 25.3551 15.6373ZM22.907 4.84635C20.9835 2.96222 17.6611 2.96222 15.7376 4.84635L13.989 6.55919L12.2404 4.84635C10.3169 2.96222 6.99451 2.96222 5.07102 4.84635C4.02184 5.87406 3.49726 7.24433 3.49726 8.61461C3.49726 13.7531 13.989 22.3174 13.989 22.3174C13.989 22.3174 24.4808 13.7531 24.4808 8.61461C24.4808 7.24433 23.9562 5.87406 22.907 4.84635Z" fill="#E27575"/>
							</svg>
						</button>

					</div>
				</div>

				<!-- middle part -->
				<div class="middle__wrapper d-flex">
					<div class="">
						<del class="price">Rs 45.00</del><small>( Inclusive of all taxes )</small>
						<h3 class="price__title"><span class="price">Rs 35.00</span>/kg</h3>
						<div class="action d-flex mob-input">
							<button class="package" data-toggle="modal" data-target="#package_modal">
								<svg width="28" height="28" viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M18.3899 5.61019H16.7506C16.0584 5.61019 15.512 5.06374 15.512 4.37157C15.512 3.67941 16.0584 3.13296 16.7506 3.13296H18.3535V1.53004C18.3535 0.837876 18.8999 0.291428 19.5921 0.291428C20.2843 0.291428 20.8307 0.837876 20.8307 1.53004V3.13296H22.4336C23.1258 3.13296 23.6723 3.67941 23.6723 4.37157C23.6723 5.06374 23.1258 5.61019 22.4336 5.61019H20.8307V7.2131C20.8307 7.90527 20.2843 8.45172 19.5921 8.45172C18.8999 8.45172 18.3535 7.90527 18.3535 7.2131V5.61019H18.3899Z" fill="#269116"/>
										<path fill-rule="evenodd" clip-rule="evenodd" d="M21.4863 20H17.7341C16.3497 20 15.2204 18.8707 15.2204 17.4863V13.7341C15.2204 12.3497 16.3497 11.2204 17.7341 11.2204H21.4863C22.8707 11.2204 24 12.3497 24 13.7341V17.4863C24 18.8707 22.8707 20 21.4863 20ZM21.4863 13.7341H17.7341V17.4863H21.4863V13.7341ZM10.2659 20H6.51366C5.12933 20 4 18.8707 4 17.4863V13.7341C4 12.3497 5.12933 11.2204 6.51366 11.2204H10.2659C11.6503 11.2204 12.7796 12.3497 12.7796 13.7341V17.4863C12.7432 18.8707 11.6138 20 10.2659 20ZM10.2659 13.7341H6.51366V17.4863H10.2659V13.7341ZM10.2659 8.74317H6.51366C5.12933 8.74317 4 7.61384 4 6.26594V2.51366C4 1.12933 5.12933 0 6.51366 0H10.2659C11.6138 0 12.7432 1.12933 12.7432 2.51366V6.26594C12.7432 7.61384 11.6138 8.74317 10.2659 8.74317ZM10.2659 2.51366H6.51366V6.26594H10.2659V2.51366Z" fill="#269116"/>
									</g>
								</svg>

								<span>Add to Package</span>
							</button>
							<button class="cart">
								
								<svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0609 10.075L23.4609 23.075C23.1359 24.7 21.6734 26 20.0484 26H6.23594C4.61094 26 3.14844 24.7 2.82344 23.075L0.0609375 10.075C-0.101562 9.2625 0.0609375 8.2875 0.548438 7.6375C1.19844 6.825 2.17344 6.5 2.98594 6.5H6.56094C6.56094 2.925 9.48594 0 13.0609 0C16.6359 0 19.5609 2.925 19.5609 6.5H23.1359C23.9484 6.5 24.9234 6.825 25.4109 7.6375C26.0609 8.2875 26.2234 9.1 26.0609 10.075ZM5.91094 22.425C5.91094 22.5875 6.07344 22.75 6.23594 22.75H19.8859C20.0484 22.75 20.2109 22.5875 20.2109 22.425L20.8609 19.5H5.26094L5.91094 22.425ZM13.0609 3.25C11.2734 3.25 9.81094 4.7125 9.81094 6.5H16.3109C16.3109 4.7125 14.8484 3.25 13.0609 3.25ZM3.31094 9.75L4.61094 16.25H21.5109L22.8109 9.75H3.31094Z" fill="#fff"/>
								</svg>

								<span>Add to Cart</span>
							</button>
						</div>
					</div>
					
					<div class="qty">
						<label for="qty">Kilogram</label>
						<div class="form-group">
							<button class="dec">-</button>
							<input type="number" min="0" max="5" value="1" class="form-control" disabled="" id="qty">
							<button class="inc">+</button>
						</div>
					</div>
				</div>

				<div class="bottom__wrapper d-flex">
					<div>
						<button class="delivery">
							<svg width="39" height="46" viewBox="0 0 39 46" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M15.6713 6.96503C15.6713 5.04169 17.2305 3.48252 19.1538 3.48252C21.0772 3.48252 22.6364 5.04169 22.6364 6.96503C22.6364 8.88838 21.0772 10.4476 19.1538 10.4476C17.2305 10.4476 15.6713 8.88838 15.6713 6.96503ZM19.1538 0C15.3072 0 12.1888 3.11835 12.1888 6.96503C12.1888 10.8117 15.3072 13.9301 19.1538 13.9301C23.0005 13.9301 26.1189 10.8117 26.1189 6.96503C26.1189 3.11835 23.0005 0 19.1538 0ZM29.6014 5.22377C28.6397 5.22377 27.8601 6.00336 27.8601 6.96503C27.8601 7.9267 28.6397 8.70629 29.6014 8.70629H36.5664C37.5281 8.70629 38.3077 7.9267 38.3077 6.96503C38.3077 6.00336 37.5281 5.22377 36.5664 5.22377H29.6014ZM0 6.96503C0 6.00336 0.779588 5.22377 1.74126 5.22377H8.70629C9.66796 5.22377 10.4476 6.00336 10.4476 6.96503C10.4476 7.9267 9.66796 8.70629 8.70629 8.70629H1.74126C0.779588 8.70629 0 7.9267 0 6.96503ZM17.4126 34.8252C17.4126 33.8715 18.2001 33.0839 19.1538 33.0839C20.1076 33.0839 20.8951 33.8715 20.8951 34.8252L20.8951 38.3077L20.8951 40.049C20.8951 41.0027 20.1076 41.7902 19.1538 41.7902C18.2001 41.7902 17.4126 41.0027 17.4126 40.049V38.3103L17.4126 38.3077L17.4126 38.3051V34.8252ZM24.3776 36.5664V34.8252C24.3776 31.9481 22.0309 29.6014 19.1538 29.6014C16.2768 29.6014 13.9301 31.9481 13.9301 34.8252V36.5664H10.4476V22.114C10.4476 20.4638 11.7575 19.1538 13.4077 19.1538H24.9C26.5502 19.1538 27.8601 20.4638 27.8601 22.114V36.5664H24.3776ZM24.3776 40.0489H29.6014C30.5631 40.0489 31.3427 39.2693 31.3427 38.3077V22.114C31.3427 18.5404 28.4736 15.6713 24.9 15.6713H13.4077C9.83413 15.6713 6.96503 18.5404 6.96503 22.114V38.3077C6.96503 39.2694 7.74462 40.049 8.70629 40.049L13.9301 40.049C13.9301 42.926 16.2768 45.2727 19.1538 45.2727C22.0309 45.2727 24.3776 42.926 24.3776 40.049V40.0489ZM12.1888 22.6364C12.1888 21.6747 12.9684 20.8951 13.9301 20.8951H15.6713C16.633 20.8951 17.4126 21.6747 17.4126 22.6364C17.4126 23.598 16.633 24.3776 15.6713 24.3776H13.9301C12.9684 24.3776 12.1888 23.598 12.1888 22.6364ZM13.9301 26.1189C12.9684 26.1189 12.1888 26.8985 12.1888 27.8601C12.1888 28.8218 12.9684 29.6014 13.9301 29.6014H15.6713C16.633 29.6014 17.4126 28.8218 17.4126 27.8601C17.4126 26.8985 16.633 26.1189 15.6713 26.1189H13.9301Z" fill="#269116"/>
							</svg>

							<span>Delivery in today 2-3 hours</span>
						</button>
					</div>						
					<form action="" class="form-inline">


						<label for="pin">
							<svg width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M6 16.5C4 16.5 0 10 0 6.5C0 3.2 2.7 0.5 6 0.5C9.3 0.5 12 3.2 12 6.5C12 10 8 16.5 6 16.5ZM6 2.5C3.8 2.5 2 4.3 2 6.5C2.2 8.4 2.9 10.2 4 11.8C4.5 12.6 5 13.3 5.6 13.9C5.8 14.2 6 14.4 6 14.4C6 14.4 6.2 14.2 6.5 13.9C7 13.3 7.6 12.6 8 11.8C9.1 10.2 9.8 8.4 10 6.5C10 4.3 8.2 2.5 6 2.5ZM6 8.5C4.9 8.5 4 7.6 4 6.5C4 5.4 4.9 4.5 6 4.5C7.1 4.5 8 5.4 8 6.5C8 7 7.8 7.5 7.4 7.9C7 8.3 6.5 8.5 6 8.5Z" fill="#269116"/>
							</svg>

							Delivery to
						</label>
						<div class="form-group">
							<input type="number" class="form-control" placeholder="Enter pincode" id="pin">
							<button class="" type="submit">Check</button>
						</div>						
					</form>

				</div>

				<div class="description">
					<h2 class="section-title">Description</h2>
					<div class="para hide">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo provident ab iste amet cupiditate vitae possimus commodi doloremque, ea modi dolores deleniti ad veniam laborum, nesciunt. Blanditiis odit dolore tempore! Quam saepe possimus ut soluta eveniet repellendus hic perferendis dolorum.
						</p>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo provident ab iste amet cupiditate vitae possimus commodi doloremque, ea modi dolores deleniti ad veniam laborum, nesciunt. Blanditiis odit dolore tempore! Quam saepe possimus ut soluta eveniet repellendus hic perferendis dolorum.
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo provident ab iste amet cupiditate vitae possimus commodi doloremque, ea modi dolores deleniti ad veniam laborum, nesciunt. Blanditiis odit dolore tempore! Quam saepe possimus ut soluta eveniet repellendus hic perferendis dolorum.
						</p>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo provident ab iste amet cupiditate vitae possimus commodi doloremque, ea modi dolores deleniti ad veniam laborum, nesciunt. Blanditiis odit dolore tempore! Quam saepe possimus ut soluta eveniet repellendus hic perferendis dolorum.
						</p>
					</div>
					<a href="#!" class="readmore">Read more <i class="material-icons">chevron_right</i></a>
				</div>

				
			</aside>
		</div>
	</section>
	<section class="fresh-vegetables sweet-fruits">
		<div class="section-rule">
			<div class="title-wrapper">
				<h2 class="section-title">You may also like</h2>
				<a href='./category-page.php'>View all</a>
			</div>
			<div class="row">
				<article class="col-6 col-md-4 col-xl-3">
					<div class="card" >
						<a href="./single-page.php" class="card__img">
							<img src="./gallery/sweetfruits/Rectangle 17.jpg" alt="">
						</a>
						<div class="card__body">
							<div class="card__top">
								<div class="card_title--wrapper">
									<p class="price del">RS. 360.00</p>
									<p class="price"><b>Rs. 299.00 </b>/Kg</p>
									<h2 class="card__title"><a href="./single-page.php">Pomegrante</a></h2>
								</div>
								<button class="wishlist"><svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M25.3551 15.6373C24.3059 17.1788 23.0819 18.5491 21.8578 19.9194C20.6338 21.2897 19.4098 22.4887 18.0109 23.6877C17.3114 24.3728 16.612 24.8866 16.2622 25.2292C15.0382 26.2569 13.1147 26.2569 11.7158 25.2292C11.3661 24.8866 10.6666 24.3728 9.96718 23.6877C8.74314 22.3174 7.34424 21.1184 6.1202 19.7481C4.89616 18.3778 3.67212 17.0076 2.62294 15.6373C1.04918 13.5819 0.174863 11.1839 0 8.61461C0 6.38791 0.874314 4.16121 2.44808 2.44836C5.59561 -0.463476 10.6666 -0.806045 13.989 1.93451C17.3114 -0.806045 22.3824 -0.634761 25.53 2.44836C27.2786 4.16121 28.1529 6.38791 27.978 8.61461C27.8032 11.1839 26.9289 13.5819 25.3551 15.6373ZM22.907 4.84635C20.9835 2.96222 17.6611 2.96222 15.7376 4.84635L13.989 6.55919L12.2404 4.84635C10.3169 2.96222 6.99451 2.96222 5.07102 4.84635C4.02184 5.87406 3.49726 7.24433 3.49726 8.61461C3.49726 13.7531 13.989 22.3174 13.989 22.3174C13.989 22.3174 24.4808 13.7531 24.4808 8.61461C24.4808 7.24433 23.9562 5.87406 22.907 4.84635Z" fill="#E27575"/ id="heartsvg">
									</svg>
								</button>

							</div>

							<div class="action d-flex">
								<button class="cart">
									<svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0609 10.075L23.4609 23.075C23.1359 24.7 21.6734 26 20.0484 26H6.23594C4.61094 26 3.14844 24.7 2.82344 23.075L0.0609375 10.075C-0.101562 9.2625 0.0609375 8.2875 0.548438 7.6375C1.19844 6.825 2.17344 6.5 2.98594 6.5H6.56094C6.56094 2.925 9.48594 0 13.0609 0C16.6359 0 19.5609 2.925 19.5609 6.5H23.1359C23.9484 6.5 24.9234 6.825 25.4109 7.6375C26.0609 8.2875 26.2234 9.1 26.0609 10.075ZM5.91094 22.425C5.91094 22.5875 6.07344 22.75 6.23594 22.75H19.8859C20.0484 22.75 20.2109 22.5875 20.2109 22.425L20.8609 19.5H5.26094L5.91094 22.425ZM13.0609 3.25C11.2734 3.25 9.81094 4.7125 9.81094 6.5H16.3109C16.3109 4.7125 14.8484 3.25 13.0609 3.25ZM3.31094 9.75L4.61094 16.25H21.5109L22.8109 9.75H3.31094Z" fill="#269116"/>
									</svg>
									<label>Add to Cart</label>
								</button>
								<div class="form-group">
									<input type="number" min="0" max="5" value="1" class="form-control" disabled="">
									<button class="inc">+</button>
									<button class="dec">-</button>
								</div>
							</div>
						</div>	
					</div>
				</article>
				<article class="col-6 col-md-4 col-xl-3">
					<div class="card">
						<a href="./single-page.php" class="card__img">
							<img src="./gallery/sweetfruits/Rectangle 17-2.jpg" alt="">
						</a>
						<div class="card__body">
							<div class="card__top">
								<div class="card_title--wrapper">
									<p class="price del">RS. 180.00</p>
									<p class="price"><b>Rs. 130.00 </b>/dozon</p>
									<h2 class="card__title"><a href="./single-page.php">Sweet Banana</a></h2>
								</div>
								<button class="wishlist"><svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M25.3551 15.6373C24.3059 17.1788 23.0819 18.5491 21.8578 19.9194C20.6338 21.2897 19.4098 22.4887 18.0109 23.6877C17.3114 24.3728 16.612 24.8866 16.2622 25.2292C15.0382 26.2569 13.1147 26.2569 11.7158 25.2292C11.3661 24.8866 10.6666 24.3728 9.96718 23.6877C8.74314 22.3174 7.34424 21.1184 6.1202 19.7481C4.89616 18.3778 3.67212 17.0076 2.62294 15.6373C1.04918 13.5819 0.174863 11.1839 0 8.61461C0 6.38791 0.874314 4.16121 2.44808 2.44836C5.59561 -0.463476 10.6666 -0.806045 13.989 1.93451C17.3114 -0.806045 22.3824 -0.634761 25.53 2.44836C27.2786 4.16121 28.1529 6.38791 27.978 8.61461C27.8032 11.1839 26.9289 13.5819 25.3551 15.6373ZM22.907 4.84635C20.9835 2.96222 17.6611 2.96222 15.7376 4.84635L13.989 6.55919L12.2404 4.84635C10.3169 2.96222 6.99451 2.96222 5.07102 4.84635C4.02184 5.87406 3.49726 7.24433 3.49726 8.61461C3.49726 13.7531 13.989 22.3174 13.989 22.3174C13.989 22.3174 24.4808 13.7531 24.4808 8.61461C24.4808 7.24433 23.9562 5.87406 22.907 4.84635Z" fill="#E27575"/ id="heartsvg">
									</svg>
								</button>

							</div>

							<div class="action d-flex">
								<button class="cart">
									<svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0609 10.075L23.4609 23.075C23.1359 24.7 21.6734 26 20.0484 26H6.23594C4.61094 26 3.14844 24.7 2.82344 23.075L0.0609375 10.075C-0.101562 9.2625 0.0609375 8.2875 0.548438 7.6375C1.19844 6.825 2.17344 6.5 2.98594 6.5H6.56094C6.56094 2.925 9.48594 0 13.0609 0C16.6359 0 19.5609 2.925 19.5609 6.5H23.1359C23.9484 6.5 24.9234 6.825 25.4109 7.6375C26.0609 8.2875 26.2234 9.1 26.0609 10.075ZM5.91094 22.425C5.91094 22.5875 6.07344 22.75 6.23594 22.75H19.8859C20.0484 22.75 20.2109 22.5875 20.2109 22.425L20.8609 19.5H5.26094L5.91094 22.425ZM13.0609 3.25C11.2734 3.25 9.81094 4.7125 9.81094 6.5H16.3109C16.3109 4.7125 14.8484 3.25 13.0609 3.25ZM3.31094 9.75L4.61094 16.25H21.5109L22.8109 9.75H3.31094Z" fill="#269116"/>
									</svg>
									<label>Add to Cart</label>
								</button>
								<div class="form-group">
									<input type="number" min="0" max="5" value="1" class="form-control" disabled="">
									<button class="inc">+</button>
									<button class="dec">-</button>
								</div>
							</div>
						</div>	
					</div>
				</article>
				<article class="col-6 col-md-4 col-xl-3">
					<div class="card">
						<a href="./single-page.php" class="card__img">
							<img src="./gallery/sweetfruits/Rectangle 17-4.jpg" alt="">
						</a>
						<div class="card__body">
							<div class="card__top">
								<div class="card_title--wrapper">
									<p class="price del">RS. 410.00</p>
									<p class="price"><b>Rs. 380.00 </b>/Kg</p>
									<h2 class="card__title"><a href="./single-page.php">Orgaic Sweet Strawberry</a></h2>
								</div>
								<button class="wishlist"><svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M25.3551 15.6373C24.3059 17.1788 23.0819 18.5491 21.8578 19.9194C20.6338 21.2897 19.4098 22.4887 18.0109 23.6877C17.3114 24.3728 16.612 24.8866 16.2622 25.2292C15.0382 26.2569 13.1147 26.2569 11.7158 25.2292C11.3661 24.8866 10.6666 24.3728 9.96718 23.6877C8.74314 22.3174 7.34424 21.1184 6.1202 19.7481C4.89616 18.3778 3.67212 17.0076 2.62294 15.6373C1.04918 13.5819 0.174863 11.1839 0 8.61461C0 6.38791 0.874314 4.16121 2.44808 2.44836C5.59561 -0.463476 10.6666 -0.806045 13.989 1.93451C17.3114 -0.806045 22.3824 -0.634761 25.53 2.44836C27.2786 4.16121 28.1529 6.38791 27.978 8.61461C27.8032 11.1839 26.9289 13.5819 25.3551 15.6373ZM22.907 4.84635C20.9835 2.96222 17.6611 2.96222 15.7376 4.84635L13.989 6.55919L12.2404 4.84635C10.3169 2.96222 6.99451 2.96222 5.07102 4.84635C4.02184 5.87406 3.49726 7.24433 3.49726 8.61461C3.49726 13.7531 13.989 22.3174 13.989 22.3174C13.989 22.3174 24.4808 13.7531 24.4808 8.61461C24.4808 7.24433 23.9562 5.87406 22.907 4.84635Z" fill="#E27575"/ id="heartsvg">
									</svg>
								</button>

							</div>

							<div class="action d-flex">
								<button class="cart">
									<svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0609 10.075L23.4609 23.075C23.1359 24.7 21.6734 26 20.0484 26H6.23594C4.61094 26 3.14844 24.7 2.82344 23.075L0.0609375 10.075C-0.101562 9.2625 0.0609375 8.2875 0.548438 7.6375C1.19844 6.825 2.17344 6.5 2.98594 6.5H6.56094C6.56094 2.925 9.48594 0 13.0609 0C16.6359 0 19.5609 2.925 19.5609 6.5H23.1359C23.9484 6.5 24.9234 6.825 25.4109 7.6375C26.0609 8.2875 26.2234 9.1 26.0609 10.075ZM5.91094 22.425C5.91094 22.5875 6.07344 22.75 6.23594 22.75H19.8859C20.0484 22.75 20.2109 22.5875 20.2109 22.425L20.8609 19.5H5.26094L5.91094 22.425ZM13.0609 3.25C11.2734 3.25 9.81094 4.7125 9.81094 6.5H16.3109C16.3109 4.7125 14.8484 3.25 13.0609 3.25ZM3.31094 9.75L4.61094 16.25H21.5109L22.8109 9.75H3.31094Z" fill="#269116"/>
									</svg>
									<label>Add to Cart</label>
								</button>
								<div class="form-group">
									<input type="number" min="0" max="5" value="1" class="form-control" disabled="">
									<button class="inc">+</button>
									<button class="dec">-</button>
								</div>
							</div>
						</div>	
					</div>
				</article>
				<article class="col-6 col-md-4 col-xl-3">
					<div class="card">
						<a href="./single-page.php" class="card__img">
							<img src="./gallery/sweetfruits/Rectangle 17-6.jpg" alt="">
						</a>
						<div class="card__body">
							<div class="card__top">
								<div class="card_title--wrapper">
									<p class="price del">RS. 290.00</p>
									<p class="price"><b>Rs. 260.00 </b>/Kg</p>
									<h2 class="card__title"><a href="./single-page.php">Orgaic Apple</a></h2>
								</div>
								<button class="wishlist"><svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M25.3551 15.6373C24.3059 17.1788 23.0819 18.5491 21.8578 19.9194C20.6338 21.2897 19.4098 22.4887 18.0109 23.6877C17.3114 24.3728 16.612 24.8866 16.2622 25.2292C15.0382 26.2569 13.1147 26.2569 11.7158 25.2292C11.3661 24.8866 10.6666 24.3728 9.96718 23.6877C8.74314 22.3174 7.34424 21.1184 6.1202 19.7481C4.89616 18.3778 3.67212 17.0076 2.62294 15.6373C1.04918 13.5819 0.174863 11.1839 0 8.61461C0 6.38791 0.874314 4.16121 2.44808 2.44836C5.59561 -0.463476 10.6666 -0.806045 13.989 1.93451C17.3114 -0.806045 22.3824 -0.634761 25.53 2.44836C27.2786 4.16121 28.1529 6.38791 27.978 8.61461C27.8032 11.1839 26.9289 13.5819 25.3551 15.6373ZM22.907 4.84635C20.9835 2.96222 17.6611 2.96222 15.7376 4.84635L13.989 6.55919L12.2404 4.84635C10.3169 2.96222 6.99451 2.96222 5.07102 4.84635C4.02184 5.87406 3.49726 7.24433 3.49726 8.61461C3.49726 13.7531 13.989 22.3174 13.989 22.3174C13.989 22.3174 24.4808 13.7531 24.4808 8.61461C24.4808 7.24433 23.9562 5.87406 22.907 4.84635Z" fill="#E27575"/ id="heartsvg">
									</svg>
								</button>

							</div>

							<div class="action d-flex">
								<button class="cart">
									<svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0609 10.075L23.4609 23.075C23.1359 24.7 21.6734 26 20.0484 26H6.23594C4.61094 26 3.14844 24.7 2.82344 23.075L0.0609375 10.075C-0.101562 9.2625 0.0609375 8.2875 0.548438 7.6375C1.19844 6.825 2.17344 6.5 2.98594 6.5H6.56094C6.56094 2.925 9.48594 0 13.0609 0C16.6359 0 19.5609 2.925 19.5609 6.5H23.1359C23.9484 6.5 24.9234 6.825 25.4109 7.6375C26.0609 8.2875 26.2234 9.1 26.0609 10.075ZM5.91094 22.425C5.91094 22.5875 6.07344 22.75 6.23594 22.75H19.8859C20.0484 22.75 20.2109 22.5875 20.2109 22.425L20.8609 19.5H5.26094L5.91094 22.425ZM13.0609 3.25C11.2734 3.25 9.81094 4.7125 9.81094 6.5H16.3109C16.3109 4.7125 14.8484 3.25 13.0609 3.25ZM3.31094 9.75L4.61094 16.25H21.5109L22.8109 9.75H3.31094Z" fill="#269116"/>
									</svg>
									<label>Add to Cart</label>
								</button>
								<div class="form-group">
									<input type="number" min="0" max="5" value="1" class="form-control" disabled="">
									<button class="inc">+</button>
									<button class="dec">-</button>
								</div>
							</div>
						</div>	
					</div>
				</article>
			</div>

		</div>
	</section>


	<!-- add package -->
	<div class="modal fade login-form" id="package_modal" >
		<div class="modal-dialog modal-dialog-centered ">
			<div class="modal-content">
				<div class="modal-header">
					<div class="logo">
						<img src="./gallery/logo.png" alt="">
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="material-icons">close</span>
					</button>
				</div>
				<h5 class="modal-title" id="staticBackdropLabel">Add to your package</h5>

				<div class="modal-body">
					<ul>
						<li>
							<a data-toggle="collapse" href="#new__package" class="add_new">
								Create Package
							</a>
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
						</li>
						<li>
							<a href="#!">
								<img src="./gallery/freshveg/Rectangle 17.png" alt="">
								<small>5 items</small>
								<p class="para">Weekly veg</p>
								<div class="left">
									<span class="material-icons add">
										add
									</span>
									<span class="material-icons remove">
										remove
									</span>
									<span class="material-icons check">
										check
									</span>

								</div>
							</a>
						</li>
						<li>
							<a href="#!">
								<img src="./gallery/sweetfruits/Rectangle 17.png" alt="">
								<small>2 items</small>
								<p class="para">Weekly Fruits</p>
								<div class="left">
									<span class="material-icons add">
										add
									</span>
									<span class="material-icons remove">
										remove
									</span>
									<span class="material-icons check">
										check
									</span>

								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

</main>




<?php
include 'footer.php';
?>
<script type="text/javascript" src="./js/magnify/zoomsl.min.js"> 
</script>
<script type="text/javascript" src="./js/singlejs.js"> 
</script>


</body>
</html>
