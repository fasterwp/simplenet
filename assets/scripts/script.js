var genesis_starter_theme = (function ($) {
    'use strict';

    /**
     * Empty placeholder function.
     *
     * @since 0.1.0
     */
    var functionName = function () {

            // Remove no-js body class.
            $('body').removeClass('no-js');

            // Initialize fitVids script.
            $('.entry-content').fitVids();

            // Add has sub-sub menu class.
            $(".sub-menu .sub-menu").parent().parent().parent().addClass('menu-item-has-grandchildren');

            // Add send icon button.
            if (!$('.send-icon').length) {
                $('<i class="send-icon"></i>').insertAfter('#subbutton');
            }

            // Add menu close button.
            if (!$('.menu-close').length) {
                $('.nav-primary').prepend('<button class="menu-close"><span class="screen-reader-text">Close menu</span></button>');
            }
            $('.menu-close').on('click', function () {
                $('.nav-primary').removeClass('visible');
                $('.menu-toggle').attr('aria-expanded', 'false').attr('aria-pressed', 'false');
            });

            // Browser images.
            $('.mockup-browser').removeClass('mockup-browser').wrap("<div class='mockup-browser'></div>");
            $('.mockup-ipad').removeClass('mockup-ipad').wrap("<div class='mockup-ipad'></div>");
            $('.mockup-laptop').removeClass('mockup-laptop').wrap("<div class='mockup-laptop'><div class='screen'></div></div>");
            $('.mockup-laptop').prepend('<span class="shadow"></span><span class="lid"></span><span class="camera"></span>');
            $('.mockup-laptop').append('<span class="chassis"><span class="keyboard"></span><span class="trackpad"></span></span>');

            if ( $('body').hasClass('front-page')) {
                // Front page animation effects.
                $('.front-page-1 .widget').addClass('fadeInUp');

                var front_page_2 = $('.front-page-2 .widget');

                var windowHeight = $(window).height(),
                    offset = front_page_2.offset().top,
                    top = offset - $(document).scrollTop(),
                    percent = Math.floor(top / windowHeight * 100);

                if (percent < 80) {
                    front_page_2.addClass('fadeInUp');
                }

                $(window).scroll(function () {
                    var front_page_widgets = $('.front-page .content .widget');

                    $.each(front_page_widgets, function () {
                        var windowHeight = $(window).height(),
                            offset = $(this).offset().top,
                            top = offset - $(document).scrollTop(),
                            percent = Math.floor(top / windowHeight * 100);

                        if (percent < 80) {
                            $(this).addClass('fadeInUp');
                        }
                    });
                });
            }

        },

        /**
         * Fire events on document ready, and bind other events.
         *
         * @since 0.1.0
         */
        ready = function () {
            functionName();

            // Examples binding to events.
            // $(window).on('resize.genesis_starter_theme', functionName);
            // $(window).on('scroll.genesis_starter_theme resize.genesis_starter_theme', functionName);
        };

    // Only expose the ready function to the world
    return {
        ready: ready
    };

})(jQuery);

jQuery(genesis_starter_theme.ready);