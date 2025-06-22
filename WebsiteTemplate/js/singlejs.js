$(document).ready(function(){
	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		infinite: false,
		asNavFor: '.slider-nav',
		pauseOnHover:false,
		responsive: [
		{
			breakpoint: 840,
			settings: {
				dots:true,
			},
		},
		
		]
	});
	var sliderN= $(".slider-nav .item" ).length;
	$('.slider-nav').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		asNavFor: '.slider-for',
		dots: false,
		focusOnSelect: true,
		infinite: true,
		centerMode:true,
		arrows:true,
		setPosition:0,
		draggable:false,
		accessibility: false,
		centerPadding:'10px',
		prevArrow:"<button class=' slick-prev hidden'><i class='material-icons'>chevron_left</i></button>",
		nextArrow:"<button class=' slick-next '><i class='material-icons'>chevron_right</i></button>",
		responsive: [
		{
			breakpoint: 1025,
			settings: {
				slidesToShow: 3.4,
			},
		},
		
		]
	});
	
	
	$('[data-fancybox="gallery"]').fancybox({
	});

	if($(window).width()>=778){
		$(function(){
			$(".slider-for .card-image img").imagezoomsl({
				zoomstart: 2,
				magnifycursor: 'crosshair',
				statusdivborder: '4px solid #ddd',
				magnifiersize: [430, 430],
			});
		});
	}

	$('.description .readmore').click((e)=>{
		$('.description .para > *').slideToggle();
		$('.description .para').toggleClass('show')
		if($(e.target).html()==='Read more <i class="material-icons">chevron_right</i>'){
			$(e.target).html('Read less <i class="material-icons">chevron_right</i>')
		}
		else{
			$(e.target).html('Read more <i class="material-icons">chevron_right</i>')
		}
	})

	$('#package_modal li a:not(".add_new")').click(function(e){
		// if($(this).hasClass('active')){
		// 	$(this).removeClass('active');
		// }
		// else
			$(this).addClass('active');

	})


});


