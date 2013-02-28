define(function(require, exports, module) {

    return function ( $, window, document, undefined ) {

        'use strict';
        
        var pluginName = "mobileMenu",
            defaults = {
                target: "#nav-mainmenu"
            };

        function Plugin( element, options ) {
            this.element = element;
            this.options = $.extend( {}, defaults, options );
            this._defaults = defaults;
            this._name = pluginName;

            this.init();
        }

        Plugin.prototype = {

            init: function() {
                this.toggleLayout(this.element, this.options)
            },

            toggleLayout: function(el, opt) {
                $(el).click(function(e) {
                    $(opt.target).toggleClass('show');
                    $(this).toggleClass('open');
                        
                    e.preventDefault();
                });
            }
        };

        $.fn[pluginName] = function ( options ) {
            return this.each(function () {
                if (!$.data(this, "plugin_" + pluginName)) {
                    $.data(this, "plugin_" + pluginName, new Plugin( this, options ));
                }
            });
        };

    }
});