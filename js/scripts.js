import underscore from '../node_modules/underscore/underscore.js'

(function ($, root, undefined) {

    $(function () {

        'use strict';



        var $form_buttons = $('.form_button');
        $form_buttons.each(function(i){
            var $button = $(this);

            var $checkboxes = $('input[type="checkbox"]', $button);

            var $span = $('span', $button);

            var $nicer_select = $('.nicer_select', $button);

            $button.on('click', function(e){

                $nicer_select.toggleClass('visible');

            });


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

            })




        });




    });

})(jQuery, this);
