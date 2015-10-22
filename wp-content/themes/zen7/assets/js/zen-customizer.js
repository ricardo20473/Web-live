var ZenCustomizer = {

	customizerContainer		: 	null,
	settingsIconContainer	: 	null,
	htmlContainer			: 	jQuery('html'),
	headerContainer			: 	null,
	headerCurrentClass		: 	'header-style-02',
    removedScroll           :   false,

	// Init the customizer
	init : function () {

		this.customizerContainer 		= jQuery('body > .options-panel');
		this.settingsIconContainer 		= jQuery('body > .settings-panel');
		this.headerContainer			= jQuery('.header');

		this._customize();

	},

	// Customize function expects clicks in the customizerContainer
	_customize : function () {
		var objectInstance = this;

		jQuery('.options-panel .options-panel-inner > ul li img').on('click', function(){

			objectInstance._customizeBackground(jQuery(this).data('image'));

		});

	},

	// Customize Header function that respond to the ddSlick callback.
	_customizeHeader : function ( selectedData ) {
		var objectInstance = this;

		switch (selectedData.selectedIndex) {

			case 0:



			  	break;
			case 1:
			  


			  	break;
			case 2:



			  	break;
			case 3:


			  	break;
			case 4:
			  


			  	break;

		}

	},

	// Customize Layout function that respond to the ddSlick callback.
	_customizeLayout : function( selectedData ) {
		var objectInstance = this;

		if ( selectedData.selectedIndex == 0 ) {

			objectInstance.htmlContainer.removeClass( 'boxed' );

		} else if ( selectedData.selectedIndex == 1) {

			objectInstance.htmlContainer.addClass( 'boxed' );

		}

	},

	// Customize Header function that respond on click.
	_customizeBackground : function (imgSrc) {
		var objectInstance = this;

		jQuery('html.boxed').css('background','url('+ imgSrc +') fixed');

	},

    _customizeScroll : function (selectedData ) {
        var obj = this;
        if ( selectedData.selectedIndex == 1 ){
            jQuery("html").getNiceScroll().remove();
            obj.removedScroll = true;
        } else if(obj.removedScroll) {
            jQuery("html").niceScroll();
        }
    },

	_resetMenu : function () {

		jQuery('nav.phone-menu > ul li').click(function(){

			jQuery(this).find('ul:first').slideToggle();

		});

	}

};
ZenCustomizer.init();