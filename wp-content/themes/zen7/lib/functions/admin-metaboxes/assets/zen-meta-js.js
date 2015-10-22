jQuery(document).ready(function($){

    var header_style = {

        revSlider : null,
        parallax  : null,
        defaultStyle : null,
        optionsPanel : null,
        divider : null,

        Init : function() {

            this.optionsPanel = jQuery('.rwmb-meta-box > .custom-header-select');
            this.revSlider = jQuery('.rwmb-meta-box > .rev_slider_meta');
            this.parallax  = jQuery('.rwmb-meta-box > .parallax_meta');
            this.divider   = jQuery('.rwmb-meta-box > .header_style_divider');
            this.defaultStyle = jQuery('.rwmb-meta-box > .default_header_style');

            this._hideAllMeta();

            var option = jQuery('.custom-header-select input:checked').val();

            this._showMeta(option);

            var obj = this;

            obj.optionsPanel.find('label').on('click', function(){

                obj._showMeta(jQuery(this).find('input').val());

            });

        },

        _hideAllMeta : function() {
            var obj = this;

            obj.revSlider.hide();
            obj.parallax.hide();
            obj.divider.hide();
            obj.defaultStyle.hide();
        },

        _showMeta : function(option) {
            var obj = this;

            switch (option) {
                case 'slider' :
                    obj._hideAllMeta();
                    obj.divider.show();
                    obj.revSlider.show();
                    break;
                case 'parallax' :
                    obj._hideAllMeta();
                    obj.divider.show();
                    obj.parallax.show();
                    break;
                case 'default' :
                    obj._hideAllMeta();
                    obj.divider.show();
                    obj.defaultStyle.show();
                    break;
                default :
                    obj._hideAllMeta();
            }
        }

    };
    header_style.Init();

    var portfolio_style = {

        optionsPanel : null,
        divider : null,
        mediaLeft : null,

        Init : function() {
            this.optionsPanel = jQuery('.rwmb-meta-box > .custom-portfolio-select');
            this.divider   = jQuery('.rwmb-meta-box > .portfolio_style_divider');
            this.mediaLeft   = jQuery('.rwmb-meta-box > .sidebar_media_type');

            this._hideAllMeta();

            var option = this.optionsPanel.find('input:checked').val();

            this._showMeta(option);

            var obj = this;

            obj.optionsPanel.find('label').on('click', function(){

                obj._showMeta(jQuery(this).find('input').val());

            });
        },

        _hideAllMeta : function () {
            var obj = this;

            obj.divider.hide();
            obj.mediaLeft.hide();
        },

        _showMeta : function(option) {
            var obj = this;

            switch (option) {
                case 'sidebar_2' :
                    obj._hideAllMeta();
                    obj.divider.show();
                    obj.mediaLeft.show();
                    break;
                default :
                    obj._hideAllMeta();
            }
        }

    };
    portfolio_style.Init();
});