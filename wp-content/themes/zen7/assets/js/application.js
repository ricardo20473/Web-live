var ZenBlog02 = {

	arrowNext			: null,
	arrowPrev			: null,
	arrowsContainer		: null,
	articleIndex		: 0,
	articlesNumber		: null,
	articles 			: [],

	init : function () {

		var objectInstance = this;

		objectInstance.arrowNext = jQuery('a.btn-down');
		objectInstance.arrowPrev = jQuery('a.btn-up');
		objectInstance.arrowsContainer = jQuery('a.btn-up').parent();
		objectInstance.arrowsContainer.css('top','0').css('position','relative').css('z-index','99');

		objectInstance._countArticles();

		objectInstance._testIndex();

		objectInstance.arrowNext.on('click', function(event) {
			event.preventDefault();

			objectInstance._nextArticle();

		});

		objectInstance.arrowPrev.on('click', function(event) {
			event.preventDefault();

			objectInstance._prevArticle();

		});

		jQuery(window).scroll(function(){
			
			jQuery.each(objectInstance.articles, function( index, value ){

				if (index < objectInstance.articlesNumber) {
					
					if (objectInstance.articles[index].offset().top-200 <= jQuery(window).scrollTop() && jQuery(window).scrollTop() < objectInstance.articles[index+1].offset().top-200)
					{
						if(index > objectInstance.articleIndex) {

							objectInstance._nextArticleLive();

						} else if (index < objectInstance.articleIndex) {

							objectInstance._prevArticleLive();

						}

					}

				} else {

					if (objectInstance.articles[index].offset().top-200 <= jQuery(window).scrollTop()) {
						if(index > objectInstance.articleIndex) {

							objectInstance._nextArticleLive();

						} else if (index < objectInstance.articleIndex) {

							objectInstance._prevArticleLive();

						}
					}

				}

			});

		});
	},

	_countArticles : function () {
		var objectInstance = this;

		jQuery('.blog-post-min').each( function( index ) {

			jQuery(this).attr('id', 'article-' + index);
			objectInstance.articlesNumber = index;
			objectInstance.articles[index] = jQuery(this);

		});
	},

	_testIndex : function () {

		var objectInstance = this;

		if (objectInstance.articleIndex == 0) {

			objectInstance.arrowPrev.hide();

		} else if (objectInstance.articleIndex == objectInstance.articlesNumber) {

			objectInstance.arrowNext.hide();

		} else {

			objectInstance.arrowPrev.show();
			objectInstance.arrowNext.show();

		}

	},

	_nextArticle : function () {

		var objectInstance = this;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex]);
		

		objectInstance._scrollToArticle(scrollHeight, objectInstance.articleIndex+1, 'down');

		objectInstance._testIndex();

	},

	_prevArticle : function () {

		var objectInstance = this;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex-1]);

		objectInstance._scrollToArticle(-scrollHeight, objectInstance.articleIndex-1, 'top');
		
		objectInstance._testIndex();

	},

	_articleHeight : function ( article ) {
		var objectInstance = this;

		var articleHeight = article.height();

		return articleHeight;
	},

	_scrollToArticle : function ( scrollHeight, index, direction ) {

		var objectInstance = this;
		var topNow = objectInstance.arrowsContainer.css('top').replace(/[^-\d\.]/g, '');
		var toScroll = +(topNow) + scrollHeight;

		id = 'article-' + index;
     
    	jQuery('html, body').animate({
        	scrollTop: jQuery("#"+id).offset().top-100
        }, 700);

	},

	_nextArticleLive : function () {

		var objectInstance = this;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex]);
		

		objectInstance._scrollToArticleLive(scrollHeight, objectInstance.articleIndex+1, 'down');

		objectInstance.articleIndex++;
		objectInstance._testIndex();
		
	},

	_prevArticleLive : function () {

		var objectInstance = this;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex-1]);


		objectInstance._scrollToArticleLive(-scrollHeight, objectInstance.articleIndex-1, 'top');
		
		objectInstance.articleIndex--;
		objectInstance._testIndex();

	},

	_scrollToArticleLive : function ( scrollHeight, index, direction ) {

		var objectInstance = this;
		var topNow = objectInstance.arrowsContainer.css('top').replace(/[^-\d\.]/g, '');
		var toScroll = objectInstance.articles[index].offset().top - objectInstance.articles[0].offset().top;

		if (direction == 'down') {

			objectInstance.arrowsContainer.animate({
				'top' : toScroll
			}, 600);

		} else if (direction == 'top') {

			objectInstance.arrowsContainer.animate({
				'top' : toScroll
			}, 600);

		}

	}

};


var ZenBlog03 = {

	arrowNext			: null,
	arrowPrev			: null,
	arrowsContainer		: null,
	articleIndex		: 0,
	articlesNumber		: null,
	socialsNumber		: null,
	articles 			: [],
	socials				: [],
	arrowsHeights		: [60, 130],

	init : function () {

		var objectInstance = this;

		objectInstance.arrowNext = jQuery('a.btn-down');
		objectInstance.arrowPrev = jQuery('a.btn-up');
		objectInstance.arrowsContainer = jQuery('a.btn-up').parent();
		objectInstance.arrowsContainer.css('top','0').css('position','relative').css('z-index','99');

		objectInstance._countArticles();

		objectInstance._testIndex();

		objectInstance.arrowNext.on('click', function(event) {
			event.preventDefault();

			objectInstance._nextArticle();

		});

		objectInstance.arrowPrev.on('click', function(event) {
			event.preventDefault();

			objectInstance._prevArticle();

		});

		objectInstance.arrowNext.hover(function(){
			objectInstance.socials[objectInstance.articleIndex].fadeOut();
		}, function(){
			objectInstance.socials[objectInstance.articleIndex].fadeIn();
		});

		jQuery(window).scroll(function(){
			
			jQuery.each(objectInstance.articles, function( index, value ){

				if (index < objectInstance.articlesNumber) {
					
					if (objectInstance.articles[index].offset().top-200 <= jQuery(window).scrollTop() && jQuery(window).scrollTop() < objectInstance.articles[index+1].offset().top-200)
					{
						if(index > objectInstance.articleIndex) {

							objectInstance._nextArticleLive();

						} else if (index < objectInstance.articleIndex) {

							objectInstance._prevArticleLive();

						}

					}

				} else {

					if (objectInstance.articles[index].offset().top-200 <= jQuery(window).scrollTop()) {
						if(index > objectInstance.articleIndex) {

							objectInstance._nextArticleLive();

						} else if (index < objectInstance.articleIndex) {

							objectInstance._prevArticleLive();

						}
					}

				}

			});

		});
	},

	_countArticles : function () {
		var objectInstance = this;

		jQuery('.blog-post-separately').each( function( index ) {

			jQuery(this).attr('id', 'article-' + index);
			objectInstance.articlesNumber = index;
			objectInstance.articles[index] = jQuery(this);

		});

		jQuery('.social-media-container').each( function( index ) {

			jQuery(this).attr('id', 'article-' + index);
			objectInstance.socials[index] = jQuery(this);
			jQuery(this).css('position','relative').css('top', '0');
			objectInstance.socialsNumber = index;

		});
	},

	_testIndex : function () {

		var objectInstance = this;

		if (objectInstance.articleIndex == 0) {

			objectInstance.arrowPrev.hide();

		} else if (objectInstance.articleIndex == objectInstance.articlesNumber) {

			objectInstance.arrowNext.hide();

		} else {

			objectInstance.arrowPrev.show();
			objectInstance.arrowNext.show();

		}

	},

	_nextArticle : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex]);
		
		switch (objectInstance.articleIndex) {

			case 0 :

				socialsGoUp = 140;
				socialsGoDown = 140;

				break;			
			case objectInstance.articlesNumber-1 :

				socialsGoUp = 0;
				socialsGoDown = 70;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}
		

		objectInstance._scrollToArticle(scrollHeight, objectInstance.articleIndex+1, -socialsGoUp, socialsGoDown, 'down');

		objectInstance._testIndex();			
		objectInstance._showAllSocials();	

	},

	_prevArticle : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex-1]);

		switch (objectInstance.articleIndex) {

			case 1 :

				socialsGoUp = 0;
				socialsGoDown = 0;

				break;			
			case objectInstance.articlesNumber :

				socialsGoUp = 0;
				socialsGoDown = 140;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}

		objectInstance._scrollToArticle(-scrollHeight, objectInstance.articleIndex-1, -socialsGoUp, socialsGoDown, 'top');
		
		objectInstance._testIndex();

	},

	_articleHeight : function ( article ) {
		var objectInstance = this;

		var articleHeight = article.height();

		return articleHeight;
	},

	_scrollToArticle : function ( scrollHeight, index, socialsGoUp, socialsGoDown, direction ) {

		var objectInstance = this;
		var topNow = objectInstance.arrowsContainer.css('top').replace(/[^-\d\.]/g, '');
		var toScroll = +(topNow) + scrollHeight;

		if (direction == 'down' && index == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-70'
			}, 600);
		}

		if (direction == 'top' && index+1 == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-140'
			}, 600);
		}

		id = 'article-' + index;
     
    	jQuery('html, body').animate({
        	scrollTop: jQuery("#"+id).offset().top-100
        }, 600);

	},

	_showAllSocials : function () {
		var objectInstance = this;

		jQuery.each(objectInstance.socials, function(index, value){

			objectInstance.socials[index].fadeIn();

		});

	},

	_nextArticleLive : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex]);
		
		switch (objectInstance.articleIndex) {

			case 0 :

				socialsGoUp = 140;
				socialsGoDown = 140;

				break;			
			case objectInstance.articlesNumber-1 :

				socialsGoUp = 0;
				socialsGoDown = 70;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}
		

		objectInstance._scrollToArticleLive(scrollHeight, objectInstance.articleIndex+1, -socialsGoUp, socialsGoDown, 'down');

		objectInstance.articleIndex++;
		objectInstance._testIndex();
		objectInstance._showAllSocials();
		
	},

	_prevArticleLive : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex-1]);

		switch (objectInstance.articleIndex) {

			case 1 :

				socialsGoUp = 0;
				socialsGoDown = 0;

				break;			
			case objectInstance.articlesNumber :

				socialsGoUp = 0;
				socialsGoDown = 140;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}

		objectInstance._scrollToArticleLive(-scrollHeight, objectInstance.articleIndex-1, -socialsGoUp, socialsGoDown, 'top');
		
		objectInstance.articleIndex--;
		objectInstance._testIndex();

	},

	_scrollToArticleLive : function ( scrollHeight, index, socialsGoUp, socialsGoDown, direction ) {

		var objectInstance = this;
		var topNow = objectInstance.arrowsContainer.css('top').replace(/[^-\d\.]/g, '');
		//var toScroll = +(topNow) + scrollHeight;
		var toScroll = objectInstance.articles[index].offset().top - objectInstance.articles[0].offset().top;

		if (direction == 'down') {

			objectInstance.arrowsContainer.animate({
				'top' : toScroll
			}, 600);

		} else if (direction == 'top') {

			objectInstance.arrowsContainer.animate({
				'top' : toScroll
			}, 700);

		}

		if (direction == 'down') {
			objectInstance.socials[index-1].animate({
				'top' : socialsGoUp
			}, 600);

			objectInstance.socials[index].animate({
				'top' : socialsGoDown
			}, 1000);
		} else if (direction == 'top') {
			objectInstance.socials[index+1].animate({
				'top' : socialsGoUp
			}, 600);

			objectInstance.socials[index].animate({
				'top' : socialsGoDown
			}, 600);
		}

		if (direction == 'down' && index == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-70'
			}, 600);
		}

		if (direction == 'top' && index+1 == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-140'
			}, 600);
		}

	}

};


var ZenBlog04 = {

	arrowNext			: null,
	arrowPrev			: null,
	arrowsContainer		: null,
	articleIndex		: 0,
	articlesNumber		: null,
	socialsNumber		: null,
	articles 			: [],
	socials				: [],
	arrowsHeights		: [60, 130],

	init : function () {

		var objectInstance = this;

		objectInstance.arrowNext = jQuery('a.btn-down');
		objectInstance.arrowPrev = jQuery('a.btn-up');
		objectInstance.arrowsContainer = jQuery('a.btn-up').parent();
		objectInstance.arrowsContainer.css('top','0').css('position','relative').css('z-index','99');

		objectInstance._countArticles();

		objectInstance._testIndex();

		objectInstance.arrowNext.on('click', function(event) {
			event.preventDefault();

			objectInstance._nextArticle();

		});

		objectInstance.arrowPrev.on('click', function(event) {
			event.preventDefault();

			objectInstance._prevArticle();

		});

		objectInstance.arrowNext.hover(function(){
			objectInstance.socials[objectInstance.articleIndex].fadeOut();
		}, function(){
			objectInstance.socials[objectInstance.articleIndex].fadeIn();
		});

		jQuery(window).scroll(function(){
			
			jQuery.each(objectInstance.articles, function( index, value ){

				if (index < objectInstance.articlesNumber) {
					
					if (objectInstance.articles[index].offset().top-200 <= jQuery(window).scrollTop() && jQuery(window).scrollTop() < objectInstance.articles[index+1].offset().top-200)
					{
						if(index > objectInstance.articleIndex) {

							objectInstance._nextArticleLive();

						} else if (index < objectInstance.articleIndex) {

							objectInstance._prevArticleLive();

						}

					}

				} else {

					if (objectInstance.articles[index].offset().top-200 <= jQuery(window).scrollTop()) {
						if(index > objectInstance.articleIndex) {

							objectInstance._nextArticleLive();

						} else if (index < objectInstance.articleIndex) {

							objectInstance._prevArticleLive();

						}
					}

				}

			});

		});
	},

	_countArticles : function () {
		var objectInstance = this;

		jQuery('.post-bdb').each( function( index ) {

			jQuery(this).attr('id', 'article-' + index);
			objectInstance.articlesNumber = index;
			objectInstance.articles[index] = jQuery(this);

		});

		jQuery('.social-media-container').each( function( index ) {

			jQuery(this).attr('id', 'article-' + index);
			objectInstance.socials[index] = jQuery(this);
			jQuery(this).css('position','relative').css('top', '0');
			objectInstance.socialsNumber = index;

		});
	},

	_testIndex : function () {

		var objectInstance = this;

		if (objectInstance.articleIndex == 0) {

			objectInstance.arrowPrev.hide();

		} else if (objectInstance.articleIndex == objectInstance.articlesNumber) {

			objectInstance.arrowNext.hide();

		} else {

			objectInstance.arrowPrev.show();
			objectInstance.arrowNext.show();

		}

	},

	_nextArticle : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex]);
		
		switch (objectInstance.articleIndex) {

			case 0 :

				socialsGoUp = 140;
				socialsGoDown = 140;

				break;			
			case objectInstance.articlesNumber-1 :

				socialsGoUp = 0;
				socialsGoDown = 70;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}
		

		objectInstance._scrollToArticle(scrollHeight, objectInstance.articleIndex+1, -socialsGoUp, socialsGoDown, 'down');

		objectInstance._testIndex();			
		objectInstance._showAllSocials();	

	},

	_prevArticle : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex-1]);

		switch (objectInstance.articleIndex) {

			case 1 :

				socialsGoUp = 0;
				socialsGoDown = 0;

				break;			
			case objectInstance.articlesNumber :

				socialsGoUp = 0;
				socialsGoDown = 140;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}

		objectInstance._scrollToArticle(-scrollHeight, objectInstance.articleIndex-1, -socialsGoUp, socialsGoDown, 'top');
		
		objectInstance._testIndex();

	},

	_articleHeight : function ( article ) {
		var objectInstance = this;

		var articleHeight = article.height();

		return articleHeight;
	},

	_scrollToArticle : function ( scrollHeight, index, socialsGoUp, socialsGoDown, direction ) {

		var objectInstance = this;
		var topNow = objectInstance.arrowsContainer.css('top').replace(/[^-\d\.]/g, '');
		var toScroll = +(topNow) + scrollHeight;

		if (direction == 'down' && index == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-70'
			}, 600);
		}

		if (direction == 'top' && index+1 == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-140'
			}, 600);
		}

		id = 'article-' + index;
     
    	jQuery('html, body').animate({
        	scrollTop: jQuery("#"+id).offset().top-100
        }, 700);

	},

	_showAllSocials : function () {
		var objectInstance = this;

		jQuery.each(objectInstance.socials, function(index, value){

			objectInstance.socials[index].fadeIn();

		});

	},

	_nextArticleLive : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex]);
		
		switch (objectInstance.articleIndex) {

			case 0 :

				socialsGoUp = 140;
				socialsGoDown = 140;

				break;			
			case objectInstance.articlesNumber-1 :

				socialsGoUp = 0;
				socialsGoDown = 70;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}
		

		objectInstance._scrollToArticleLive(scrollHeight, objectInstance.articleIndex+1, -socialsGoUp, socialsGoDown, 'down');

		objectInstance.articleIndex++;
		objectInstance._testIndex();
		objectInstance._showAllSocials();
		
	},

	_prevArticleLive : function () {

		var objectInstance = this;
		var socialsGoUp = 0;
		var socialsGoDown = 0;

		var scrollHeight = objectInstance._articleHeight(objectInstance.articles[objectInstance.articleIndex-1]);

		switch (objectInstance.articleIndex) {

			case 1 :

				socialsGoUp = 0;
				socialsGoDown = 0;

				break;			
			case objectInstance.articlesNumber :

				socialsGoUp = 0;
				socialsGoDown = 140;

				break;			
			default:

				socialsGoUp = 0;
				socialsGoDown = 140;

		}

		objectInstance._scrollToArticleLive(-scrollHeight, objectInstance.articleIndex-1, -socialsGoUp, socialsGoDown, 'top');
		
		objectInstance.articleIndex--;
		objectInstance._testIndex();

	},

	_scrollToArticleLive : function ( scrollHeight, index, socialsGoUp, socialsGoDown, direction ) {

		var objectInstance = this;
		var topNow = objectInstance.arrowsContainer.css('top').replace(/[^-\d\.]/g, '');
		//var toScroll = +(topNow) + scrollHeight;
		var toScroll = objectInstance.articles[index].offset().top - objectInstance.articles[0].offset().top;

		if (direction == 'down') {

			objectInstance.arrowsContainer.animate({
				'top' : toScroll
			}, 600);

		} else if (direction == 'top') {

			objectInstance.arrowsContainer.animate({
				'top' : toScroll
			}, 700);

		}

		if (direction == 'down') {
			objectInstance.socials[index-1].animate({
				'top' : socialsGoUp
			}, 600);

			objectInstance.socials[index].animate({
				'top' : socialsGoDown
			}, 1000);
		} else if (direction == 'top') {
			objectInstance.socials[index+1].animate({
				'top' : socialsGoUp
			}, 600);

			objectInstance.socials[index].animate({
				'top' : socialsGoDown
			}, 600);
		}

		if (direction == 'down' && index == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-70'
			}, 600);
		}

		if (direction == 'top' && index+1 == objectInstance.articlesNumber) {
			objectInstance.socials[0].animate({
				'top' : '-140'
			}, 600);
		}

	}

};



