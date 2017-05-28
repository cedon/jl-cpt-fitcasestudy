/*
Meta Box Control Functions
 */
console.log( 'Admin Script is Loaded!');

(function ($) {
    var testVar = "This is a test!";
    console.log(testVar);
    console.log( $('input[name=height_unit]:checked').val() );

})(jQuery);

console.log('Second Test: ');
console.log( jQuery('input[name=height_unit]:checked').val() );