jQuery(document).ready(function(){

	jQuery('nav.accordion > ul > li').click(function(){
		jQuery('nav.accordion > ul > li').removeClass('selected');
		jQuery('nav.accordion > ul > li').find('> ul').slideUp();
		jQuery(this).find('> ul').slideDown();
		jQuery(this).addClass('selected');
	});
	
	jQuery('nav.accordion > ul > li:first').addClass('selected');
	jQuery('nav.accordion > ul > li.selected').find('> ul').show();
});