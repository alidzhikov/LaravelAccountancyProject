/**
 * Created by Laptop on 19.1.2016 г..
 */
$( document ).ready(function() {
    var clonedC = 1;
    $('.add_new').click(function(){
        $( ".products" ).clone().attr('class','products' + clonedC + ' ' + 'products-group').insertBefore( ".add_new" );
        clonedC++;
    });

});

