jQuery(document).ready(function($){

	$('nav.phone-menu > ul li').click(function(){
		$(this).find('ul:first').slideToggle();
	});

});