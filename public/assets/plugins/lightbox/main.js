//=================================
// Flashy Demo
//=================================
$(document).ready(function() {
	'use strict';

	$('.custom').flashy({
		showClass: 'fx-fadeIn',
		hideClass: 'fx-fadeOut',
		prevShowClass: 'fx-bounceInLeft',
		nextShowClass: 'fx-bounceInRight',
		prevHideClass: 'fx-bounceOutRight',
		nextHideClass: 'fx-bounceOutLeft'
	});
});
