$(document).on('change keyup', '#amount', function () {
    console.log('caught event for amount');
    var fee = $('#fee').val();
    var amt = $('#amount').val();
    var paid = $('#amount_paid').val();
    var balance = $('#balance').val();
    var dis = 0;

    console.log('paid ' + paid);
    console.log('amount ' + amt);

    if (paid != '' && amt != '') {
        paid = parseFloat($('#amount_paid').val());
        amt = parseFloat($('#amount').val());
        balance = fee - (paid + amt)
        $('#balance').val(parseFloat(balance).toFixed(2));
    } else if (amt != '') {
        amt = parseFloat($('#amount').val());
        balance = fee - amt;
        $('#balance').val(parseFloat(balance).toFixed(2));
    }
});

//=================================================
$(document).on("change keyup", "#discount", function () {
    var fee = parseFloat($('#fee').val());
    var dis = 0;
    dis = ((fee * parseFloat($(this).val()))) / 100;
    var amt = fee * dis;
    $('#amount').val(parseInt(amt))
});