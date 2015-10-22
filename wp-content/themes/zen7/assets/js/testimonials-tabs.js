function hideTabs() {
	jQuery('ul.testimonial-author li div').each(function(){
		var href = jQuery(this).data('file');

		jQuery(href).hide();
	});
};

jQuery(document).ready(function($){

	hideTabs();

	$('ul.testimonial-author li:first div').addClass('selected');

	$('ul.testimonial-author li div').click(function(){
		var href = $(this).data('file');

		$('ul.testimonial-author li div').removeClass('selected');
		$(this).addClass('selected');
		hideTabs();

		$(href).fadeIn('fast');
	});

	$('ul.testimonial-author li div.selected').each(function(){
		var href = $(this).data('file');

		$(href).show();
	});

});