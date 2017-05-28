/*
Meta Box Control Functions
 */
console.log( 'Admin Script is Loaded!');

(function ($) {

    $(function () {
        fitcaseHeightUnit = $('input[name=fitcase_height_unit]:checked', '#post').val();
        console.log(fitcaseHeightUnit);

        var testText = $('#client_height_box').html();
        console.log(testText);
    });

})(jQuery);

