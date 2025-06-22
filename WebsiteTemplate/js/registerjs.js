$(document).ready(function(){
	var i=0;
	$('.input-group a.visibility ').click(function(){
		if(i===0){
			$(this).find('span').html('visibility');
			$(this).parent().find('input').attr('type','text');

			i=1;

		}
		else{
			$(this).find('span').html('visibility_off');
			$(this).parent().find('input').attr('type','password');
			i = 0;
			

		}

	});

	setTimeout(()=>{
		if($('.form-check input').prop("checked") == true){
			$(this).parents('form').find('button').removeClass('disabled');
			$(this).parents('form').find('button').removeAttr('disabled');
		}
		else{
			$(this).parents('form').find('button').addClass('disabled');
			$(this).parents('form').find('button').attr('disabled','disabled');
		}
	},3000)

	$('.form-check input').click(function(){
		if($(this).prop("checked") == true){
			$(this).parents('form').find('button').removeClass('disabled');
			$(this).parents('form').find('button').removeAttr('disabled');
		}
		else{
			$(this).parents('form').find('button').addClass('disabled');
			$(this).parents('form').find('button').attr('disabled','disabled');
		}
	})

	$('#regForm .login a').click(()=>{
		$('.main-menu .login.dropdown .dropdown-menu').toggleClass('show');
	});

	$(".input-code input").keyup(function () {
		$(this).next().focus();
	});
	$(".step02 .input-code input:last-child").keyup(function () {
		$(".step02 button").focus();
	});

	// step jump js
	$('.step01 button').click((e)=>{
		e.preventDefault();
		var phno= $('input[type=tel]').val();
		if( phno ){
			$('.step01').removeClass('active');
			$('.step02').addClass('active');
		}
		// return false;


	})
	$('.step02 button').click((e)=>{
		e.preventDefault();
		var otp= $('input[type=number]').val();
		if(otp){
			$('.step02').removeClass('active');
			$('.step03').addClass('active');
		}


	});


	if($(window).width()<767.5){
		$('#regForm .login a').attr('href','./login-page.php');
	}

})