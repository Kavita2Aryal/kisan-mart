$(document).ready(function(){
	$('.dropdown').hover(function(){
		$(this).children('.dropdown-menu').addClass('show');
	},
	function(){
		$(this).children('.dropdown-menu').removeClass('show');
	});

	// nav
	
	
	$('.wishlist').click(function(e){
		e.preventDefault();
		$(this).toggleClass('active');
		$('.secondary-menu .heart').addClass('added');
		setTimeout(()=>{
			$('.secondary-menu .heart').removeClass('added');
		},1000)
	});

	$('.cart').click(function(e){
		e.preventDefault();
		console.log('hi');
		$(this).find('label').html('Added to Cart')
		$(this).find('svg').hide();
		$('.secondary-menu .cart-blink').addClass('added');
		setTimeout(()=>{
			$('.secondary-menu .cart-blink').removeClass('added');
		},1000)

	});

	$('.mob-side-trg').click((e)=>{
		e.preventDefault();
		if($('.mob-side-nav').hasClass('slide')){
			$('.mob-side-nav').removeClass('slide');
			$('body').removeClass('overflow')
		}
		else{
			$('.mob-side-nav').addClass('slide');
			$('body').addClass('overflow')
		}
	})


	$('.dec').click(function() {
		var qtyNode =$(this).prev().prev();
		var qty =qtyNode.val();
		qtyNext=$(this).next();
		qtyV=$(this).next().val();

		if (qty > 1) {
			qtyNode.val(--qty);
		}
		else if(qtyV > 1){
			qtyNext.val(--qtyV);
		}
	});

	$('.inc').click(function() {
		var qtyNode =$(this).prev();
		var max= qtyNode.attr('max');
		max = parseInt(max)
		var qty =qtyNode.val();
		if (qty<max) {
			qtyNode.val(++qty);
		}
	});

	if($(window).width()<769){
		$('.dz-default.dz-message').html('Click here to Browse a Picture');
		// $('input').focusin(function() {
		// 	$('body').addClass('overflow');
		// });
		// $('input').focusout(function() {
		// 	$('body').removeClass('overflow');
		// });
		$('input:not([type="checkbox"]):not([type="radio"])').focusin(  
			function(){  
				$('.mob-input').addClass('relative');  
			}).focusout(  
			function(){  
				$('.mob-input').removeClass('relative');  
			});

		}

		$('.main-menu .form-inline input[type=search]').focusin(function() {
			$(this).keydown(function() {
				$(this).next().addClass('show');
			});	
		});

		$('.main-menu .form-inline .dropdown-menu .dropdown-item').click((e)=>{

			$('.main-menu .form-inline input[type=search]').val(e.target.innerHTML);
		});

		$('.main-menu .form-inline input[type=search]').focusout(function() {
			setTimeout(()=>{
				$(this).next().removeClass('show');
			}, 300)
		});

		if($(window).width()<1024){
			$('header:not(.mob-header)').remove();
		}
		else{
			$('header.mob-header, .mob-footer').remove();
		}




	});

$(window).on('load', function(){
	if($('main').hasClass('common-page')){
		$('.secondary-menu.nosticky').addClass('common-sticky');
		$('.secondary-menu.nosticky').removeClass('nosticky');
		var screen= $('.secondary-menu').offset().top ;

		$(window).scroll(function(){
			if( $(window).scrollTop()>=screen){
				$('.secondary-menu').removeClass('common-sticky');				
			}
			else{
				$('.secondary-menu').addClass('common-sticky');

			}
		});
		if( $(window).scrollTop()>=screen){
			$('.secondary-menu').removeClass('common-sticky');


		}
		else{
			$('.secondary-menu').addClass('common-sticky');
		}


	}


})