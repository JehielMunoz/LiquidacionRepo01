$(document).ready(Principal);

function Principal(){
	$('.page-container form').submit(logTry);
	$('.page-container form .username, .page-container form .password').keyup(function(){
		$(this).parent().find('.error').fadeOut('fast');
	});
}
function logTry(){
	var username = $(this).find('.username').val();
	var password = $(this).find('.password').val();
	if(username ==''){ //cambiar para la busqueda a base de datos
		$(this).find('.error').fadeOut('fast', function(){
			$(this).css('top', '27px');
		});
		$(this).find('.error').fadeIn('fast', function(){
			$(this).parent().find('.username').focus();
		});
		return false;
	}
	if(password == ''){ //cambiar para busqueda a base de datos
		$(this).find('.error').fadeOut('fast', function(){
			$(this).css('top','96px')
		});
		$(this).find('.error').fadeIn('fast', function(){
			$(this).parent().find('.password').focus();
		});
		return false;
	}
}

