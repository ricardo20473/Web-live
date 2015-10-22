jQuery(document).ready(function($){

	$('.toptip').tipsy({
		fade: true,
		gravity: 's'
	});
	$('.bottomtip').tipsy({
		fade: true,
		gravity: 'n'
	});
	$('.righttip').tipsy({
		fade: true,
		gravity: 'w'
	});
	$('.lefttip').tipsy({
		fade: true,
		gravity: 'e'
	});

});