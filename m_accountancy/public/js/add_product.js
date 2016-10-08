/**
 * Created by Laptop on 19.1.2016 г..
 */
$( document ).ready(function() {
    var clonedC = 1;
    $('.add_new').click(function(){
        $( ".products" ).clone(true).attr('class','products' + clonedC + ' ' + 'products-group').insertBefore( ".add_new" );
        clonedC++;
    });

    $( ".slctdPrdct" ).on('click',function() {
        console.log('clicked select');
        var priceSlctd = $(this).find( " option:selected ").attr('price');
        $(this).parent().parent().find('.actual-price').val(priceSlctd);
        console.log($(this).parent().parent());
    });




});

