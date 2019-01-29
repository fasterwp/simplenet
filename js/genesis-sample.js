/**
 * Genesis Sample entry point.
 *
 * @package GenesisSample\JS
 * @author  StudioPress
 * @license GPL-2.0+
 */

var genesisSample = ( function( $ ) {
    'use strict';

    /**
     * Adjust site inner margin top to compensate for sticky header height.
     *
     * @since 2.6.0
     */
    var moveContentBelowFixedHeader = function() {
        var siteInnerMarginTop = 0;

        if( $('.site-header').css('position') === 'fixed' ) {
            siteInnerMarginTop = $('.site-header').outerHeight();
        }

        $('.site-inner').css('margin-top', siteInnerMarginTop);
    },

    /**
     * Initialize Genesis Sample.
     *
     * Internal functions to execute on document load can be called here.
     *
     * @since 2.6.0
     */
    init = function() {
        // Run on first load.
        moveContentBelowFixedHeader();

        // Run after window resize.
        $( window ).resize(function() {
            moveContentBelowFixedHeader();
        });

        // Run after the Customizer updates.
        // 1.5s delay is to allow logo area reflow.
        if (typeof wp.customize != "undefined") {
            wp.customize.bind( 'change', function ( setting ) {
                setTimeout(function() {
                    moveContentBelowFixedHeader();
                  }, 1500);
            });
        }

        // Make sure JS class is added.
        $('body').addClass('js');

        // set the variables.
        var $header = $('.site-header'),
        $hsToggle = $('.toggle-header-search'),
        $hsWrap = $('#header-search-wrap'),
        $hsInput = $hsWrap.find('input[type="search"]');

        // Handler for click a show/hide button.
        $hsToggle.on('click', function (event) {

            event.preventDefault();

            if ($(this).hasClass('close')) {
                hideSearch();
            } else {
                showSearch();
            }

        });

        // Handler for pressing show/hide button.
        $hsToggle.on('keydown', function (event) {

            // If tabbing from toggle button, and search is hidden, exit early.
            if (event.keyCode === 9 && !$header.hasClass('search-visible')) {
                return;
            }

            event.preventDefault();
            handleKeyDown(event);

        });

        // Handler for tabbing out of the search bar when focused.
        $hsInput.on('keydown', function (event) {

            if (event.keyCode === 9) {
                hideSearch(event.target);
            }

        });

        // Helper function to show the search form.
        function showSearch() {

            $header.addClass('search-visible');
            $hsWrap.fadeIn('fast').find('input[type="search"]').focus();
            $hsToggle.attr('aria-expanded', true);

        }

        // Helper function to hide the search form.
        function hideSearch() {

            $hsWrap.fadeOut('fast').parents('.site-header').removeClass('search-visible');
            $hsToggle.attr('aria-expanded', false);

        }

        // Keydown handler function for toggling search field visibility.
        function handleKeyDown(event) {

            // Enter/Space, respectively.
            if (event.keyCode === 13 || event.keyCode === 32) {

                event.preventDefault();

                if ($(event.target).hasClass('close')) {
                    hideSearch();
                } else {
                    showSearch();
                }

            }

        }
    };

    // Expose the init function only.
    return {
        init: init
    };

})( jQuery );

jQuery( window ).on( 'load', genesisSample.init );
