import underscore from '../node_modules/underscore/underscore.js'

(function ($, root, undefined) {

    $(function () {

        'use strict';


        $(document).on('keydown', function(e){
            if(e.keyCode == 27 ){
                // if pressing escape
            }
        }).on('click', function(e){
            // hide nicerselects when click on rest of window, except for button
            $('.nicer_select').removeClass('visible');
        })




        // HEADER SLIDE NAVIGATION
        $('nav a').on('click', function(e){
            e.preventDefault();
            var $id = $(this).attr('href');
            var $page_location = $($id);
            $("html, body").animate({ scrollTop: $page_location.offset().top }, 1000);
        })




        var $form_buttons = $('.form_button');
        $form_buttons.each(function(i){
            var $button = $(this);

            var $checkboxes = $('input[type="checkbox"]', $button);
            var $span = $('span', $button);
            var $nicer_select = $('.nicer_select', $button);

            $button.on('click', function(e){
                e.stopPropagation();
                $nicer_select.toggleClass('visible');
                $('.nicer_select').not($nicer_select).removeClass('visible');  // hide others


            }); // end of when you click on a form button


            var $nicer_options = $('.nicer_option', $nicer_select);
            $nicer_options.on('click', function(f) {
                f.stopPropagation();

                var $nicer_option = $(this);
                var $value = $nicer_option.data('value');

                for (var c = 0; c < $checkboxes.length; c++) {
                    var $checkbox = $($checkboxes[c]);
                    if ($checkbox.val() == $value ) {
                        var $is_checked = $checkbox.prop('checked');
                        // uncheck if checked, check if unchecked;
                        $checkbox.prop('checked' ,  !$is_checked  );
                        if ($is_checked) {
                            $nicer_option.removeClass('checked');
                        } else {
                            $nicer_option.addClass('checked');
                        }

                    };
                }

            }) // end of when you click on a nice option

        });  // end of for each form_buttons




    });

})(jQuery, this);
