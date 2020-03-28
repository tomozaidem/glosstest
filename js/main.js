var Theme = {

    disableTabStateRestore:false,

    selectLiveSearchAutoStart:0,

    init:function( $ ) {
        this._initHamburgerMenu();
        this._initMobileMenu();
    },

    _initHamburgerMenu: function() {
        var menuTrigger = jQuery('.hamburger-menu'),
            mainNav = jQuery('.main_mobile_menu');

        menuTrigger.on('click', function(e){
            e.preventDefault();
            if ( menuTrigger.hasClass('hamburger-menu-close') ) {
                menuTrigger.removeClass('hamburger-menu-close').addClass('hamburger-menu-open');
                mainNav.slideUp(300);
                jQuery('.slicknav_nav').slicknav('toggle');
            } else {
                menuTrigger.removeClass('hamburger-menu-open').addClass('hamburger-menu-close');
                mainNav.slideDown(300);
                jQuery('.slicknav_nav').slicknav('toggle');
            }
        });
    },

    /**
     * Initialization modile menu.
     * @use jquery.slicknav.js, slicknav.css
     * @return void
     */
    _initMobileMenu:function() {
        var mainBtn,
            closeClass = 'slicknav_btn--close',
            itemClass = 'slicknav_item',
            itemOpenClass = 'slicknav_item--open';

        jQuery( '#navigation' ).slicknav({
            label:'',
            prependTo:'.header__content-mobile-menu',
            openedSymbol: '',
            closedSymbol: '',
            allowParentLinks:true,
            beforeOpen: function( target ) {
                if ( target.length ) {
                    if ( target[0] == mainBtn ) {
                        target.addClass( closeClass );
                    }else if ( target.hasClass( itemClass ) ) {
                        target.addClass( itemOpenClass );
                    }
                }
            },
            beforeClose: function( target ) {
                if( target.length ){
                    if( target[0] == mainBtn ) {
                        target.removeClass( closeClass );
                    }else if( target.hasClass( itemClass ) ) {
                        target.removeClass( itemOpenClass );
                    }
                }
            }
        });

        mainBtn = jQuery( '.slicknav_btn' );
        mainBtn = mainBtn.length ? mainBtn[0] : null;
    },

    /**
     * Create slideshows.
     *
     * @param numSlides config
     */
    makeSlider: function( config ) {
        var self = this;
        var cfg = jQuery.extend( {
                sliderSelector:'',
                slideTransitionType:'',
                slideTransitionTypeMobile:'',
                nextSelector:'',
                slideTimeouts:{},
            }, config || {}),
            sliderCfg = {
                autoplay: true,
                dots: false,
                arrows: false,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                slidesToShow: 1,
                slidesToScroll: 1,
                pauseOnHover: false,
                pauseOnDotsHover: false,
                responsive:{}
            };
        if ( ! cfg.sliderSelector && ! cfg.slideTransitionType ) {
            return null;
        }

        if ( cfg.sliderOptions ) {
            jQuery.extend( sliderCfg, cfg.sliderOptions );
        }

        var slider = jQuery( cfg.sliderSelector ).slick( sliderCfg );

        if ( 'click' === cfg.slideTransitionType || 'click' === cfg.slideTransitionTypeMobile ) {
            jQuery( cfg.nextSelector ).on( 'click', function(){
                if ( 'click' === cfg.slideTransitionType ||
                    ( 'click' === cfg.slideTransitionTypeMobile || jQuery( window ).width() > 991 ) ) {
                    slider.slick('slickNext');
                }
            });
        }

        if ( cfg.slideTimeouts.length != 0 ) {
            slider.on( 'afterChange', function(e, slick) {
                slider.slick( 'setOption', 'autoplaySpeed', cfg.slideTimeouts[slick.currentSlide] );
            });
        }
    },

};

Theme.formatter = {
    configs:{},

    setConfig:function( format, cfg ) {
        this.configs[format] = cfg;
    },

    formatMoney:function( amount ) {
        var cfg = jQuery.extend({
            //mask: '{amount}',
            decimal_separator: '.',
            thousand_separator: ',',
            decimals: 2
        }, this.configs.money[ 'money' ] ? this.configs[ 'money' ] : {});

        var formatted = this.formatNumber( amount, cfg.decimals, 3, cfg.thousand_separator, cfg.decimal_separator );

        if ( cfg.mask ) {
            var completed = cfg.mask.replace( '{amount}', formatted );
            if ( completed != cfg.mask ) {
                return completed;
            }
        }

        return formatted;
    },

    formatNumber: function( number, decimals, th, thSep, decSep ) {
        var re = '\\d(?=(\\d{' + ( th || 3 ) + '})+' + ( decimals > 0 ? '\\D' : '$' ) + ')',
            number = parseFloat(number);
        num = number.toFixed( Math.max( 0, ~~decimals ) );

        return ( decSep ? num.replace( '.', decSep ) : num ).replace( new RegExp( re, 'g' ), '$&' + ( thSep || ',' ) );
    },

    /**
     * Allows format strings with %s and %d placeholders.
     *
     * @return String
     */
    sprintf:function() {
        var args = arguments,
            string = args[0],
            i = 1;

        return string.replace( /%((%)|s|d)/g, function( m ) {
            // m is the matched format, e.g. %s, %d
            var val = null;
            if ( m[2] ) {
                val = m[2];
            } else {
                val = args[i];
                switch ( m ) {
                    case '%d':
                        val = parseFloat( val );
                        if ( isNaN( val ) ) val = 0;
                        break;
                }
                i++;
            }
            return val;
        });
    },

    time:function( timeIn24Hours, format ) {
        if ( ! format || 'hh:ii' == format ) {
            return timeIn24Hours;
        }

        var parts = timeIn24Hours.split( ':' ),
            result = format.replace( 'ii', parts[1] ),
            h = parseInt( parts[0], 10 ),
            is12HoursFormat = format.search( 'A' ) >= 0,
            is12HoursFormatLowercase = format.search( 'a' ) >= 0,
            newHourValue = h;


        if ( is12HoursFormat || is12HoursFormatLowercase ) {
            var suffix = h >= 12 ? ' PM' : ' AM';
            result = result.replace( is12HoursFormatLowercase ? 'a' : 'A', is12HoursFormatLowercase ? suffix.toLowerCase() : suffix );
            if ( newHourValue >= 12 ) {
                newHourValue -= 12;
            }
            if ( 0 == newHourValue ) {
                newHourValue = 12;
            }
        }

        if ( format.search( 'hh' ) >= 0 ) {
            result = result.replace( 'hh', ( newHourValue < 10 ? '0' : '' ) + newHourValue );
        } else {
            result = result.replace( 'h', newHourValue );
        }

        return result;
    }
};

jQuery(function( $ ) {
    Theme.init( $ );
});