/**
 * Created by Laptop on 19.1.2016 г..
 */
$( document ).ready(function() {
    var clonedC = 2;
    var pastC = null;
    $('.add_new').click(function(){
        pastC = clonedC-1;
        $( ".products" + pastC ).clone(true).attr('class','products' + clonedC + ' ' + 'products-group').insertBefore( ".add_new" );
        var pastVal = $(".products" + pastC + '> .input-wrapper').find('option:selected').attr('value') ;
        $(".products" + clonedC + '> .input-wrapper option[value=' + pastVal + ']').next().attr('selected','selected');
        $('.products' + clonedC + ' > .input-wrapper > .form-control').val(0);
        clonedC++;
    });

    $( ".slctdPrdct" ).on('click',function() {
        var priceSlctd = $(this).find( " option:selected ").attr('price');
        $(this).parent().parent().find('.actual-price').val(priceSlctd);
    });
});

