

$(document).ready(function(){
	// single carousel
	$('.single-carousel').slick({
		infinite: true,
		lazyLoad: 'ondemand',
		autoplay: true,
		arrows:true,
		prevArrow:"<button class='slick-prev'><i class='material-icons  material-icons-outlined'>chevron_left</i></button>",
		nextArrow:"<button class='slick-next'><i class='material-icons material-icons-outlined'>chevron_right</i></button>",
		rewind:true,
	});
	

	// categories
	$('.todays__carousel').slick({
		infinite: false,
		lazyLoad: 'ondemand',
		slidesToShow: 4.7,
		slidesToScroll: 1,
		arrows:true,
		initialSlide:0,
		prevArrow:"<button class=' slick-prev hidden'><i class='material-icons'>chevron_left</i></button>",
		nextArrow:"<button class=' slick-next '><i class='material-icons'>chevron_right</i></button>",
		responsive: [
		{
			breakpoint: 1025,
			settings: {
				slidesToShow: 3.7,
			},
		},
		{
			breakpoint: 1002,
			settings: {
				slidesToShow: 4,
			},
		},
		{
			breakpoint: 838,
			settings: {
				slidesToShow: 3,
			},
		},
		{
			breakpoint: 601,
			settings: {
				slidesToShow: 2,
			},
		},
		{
			breakpoint: 420,
			settings: {
				slidesToShow: 1.8,
				slidesToScroll: 1,

			},
		},
		{
			breakpoint: 365,
			settings: {
				slidesToShow: 1.4,
				slidesToScroll: 1,

			},
		},
		]
	});



	var cateN= $( ".todays__carousel .item" ).length;
	var cateNA= $( ".todays__carousel .item.slick-active" ).length;


	$('.todays__carousel').on('afterChange', function (event, slick, currentSlide) {
		if(currentSlide+cateNA === cateN) {
			$(this).find('.slick-next').addClass('hidden');
		}
		else {
			$(this).find('.slick-next').removeClass('hidden');
		}
		if(currentSlide === 0) {
			$(this).find('.slick-prev').addClass('hidden');
		}
		else {
			$(this).find('.slick-prev').removeClass('hidden');
		}  
	});


	// responsive
	$('.mob-menu li.active span').removeClass('material-icons-outlined');
	if($(window).width()<450.5){
		$('.title-wrapper button').html('<span class="material-icons">arrow_right_alt</span>');
	}

})

$(window).on('load', function(){

	var screen= $('.today.today--stock').offset().top ;

	$(window).scroll(function(){
		if( $(window).scrollTop()>=screen){
			$('.secondary-menu').removeClass('nosticky');
		}
		else{
			$('.secondary-menu').addClass('nosticky');
		}
	});
	if( $(window).scrollTop()>=screen){
		$('.secondary-menu').removeClass('nosticky');
	}
	else{
		$('.secondary-menu').addClass('nosticky');
	}
})
