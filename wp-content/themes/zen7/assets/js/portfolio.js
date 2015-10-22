var PortfolioAjax = {

	itemsNumber			: null,
	minVisible			: 6,
	loadMoreButton		: null,
	itemsContainer		: null,
	items 				: [],
	filterButtons		: null,

	init : function () {
		var objectInstance = this;

		objectInstance.loadMoreButton = $('.portfolio-bg > .container > .load-more > a');
		objectInstance.itemsContainer = $('.portfolio-bg > .container > .posts-list > ul');
		objectInstance.filterButtons  = $('.portfolio-bg > .container > .categories-portfolio');
		//objectInstance.itemsNumber = objectInstance.itemsContainer.children().length;

		objectInstance.itemsContainer.children().each(function ( index ){

			objectInstance.items[index] = $(this);
			objectInstance.itemsNumber = index+1;

		});

		objectInstance._load_min_items();

		objectInstance.loadMoreButton.on('click', function(event){

			event.preventDefault();
			objectInstance._load_more_items();


		});

	},

	_load_min_items : function () {

		var objectInstance = this;

		$.each(objectInstance.items, function( index, value ){

			if ( index < objectInstance.minVisible ) {
				value.addClass('portfolio-item-visible');
			}

		});

		objectInstance.itemsContainer.isotope({ filter: '.portfolio-item-visible' });

	},

	_load_more_items : function () {

		var objectInstance = this;

		objectInstance.minVisible = objectInstance.minVisible + 3;

		$.each(objectInstance.items, function( index, value ){

			if ( index < objectInstance.minVisible && !value.hasClass('portfolio-item-visible') ) {
				value.addClass('portfolio-item-visible');
			}

		});

		objectInstance.itemsContainer.isotope({ filter: '.portfolio-item-visible' });

		if(objectInstance.minVisible >= objectInstance.itemsNumber)
			objectInstance.loadMoreButton.hide();
		
	}

};