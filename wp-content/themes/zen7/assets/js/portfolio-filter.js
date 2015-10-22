function scaleDown() {
	jQuery('.portfolio-bg nav.posts-list > ul > li').removeClass('current').addClass('not-current');
	jQuery('.portfolio-bg nav.categories-portfolio > ul li a').removeClass('selected');
}

function show(category) {
	scaleDown();
	jQuery('#' + category).addClass('selected');
	jQuery('.' + category).removeClass('not-current');
	jQuery('.' + category).addClass('current');
	if (category == "all") {
		jQuery('.portfolio-bg nav.categories-portfolio > ul li a').removeClass('selected');
		jQuery('#all').addClass('selected');
		jQuery('.portfolio-bg nav.posts-list > ul > li').removeClass('current, not-current');
	}
}

jQuery(document).ready(function() {
	jQuery('#all').addClass('selected');
	jQuery('.portfolio-bg nav.categories-portfolio > ul li a').click(function(){
		show(this.id);
	});
});