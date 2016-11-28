(function($) {
    $.fn.geShoppingCart = function(options) {
        // Init the shopping cart
        var initCart = function() {
            $.ajax({
                type: 'post',
                url: 'shop.php',
                dataType: 'json',
                success: function(data) {
                    updateCart(data);
                    console.log('Ajax request succeeded. Shopping cart initiated.');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        };

        var updateCart = function(data) {
            $('#cart-content').html(data.content);
            $('#total-num-of-items').html(data.totalNumOfItems);
            $('#total-sum').html(data.totalSum);
            $('#status').html('Shopping cart refreshed.');

            console.log('Shopping cart updated.');
        };

        var updatePayDesk = function(data) {
            $('#payment-amount').html(data.totalSum);
            $('#output').html(data.output);
            if (data.status === 'success') {
                $('#output').removeClass('failure').addClass('success');
                $("#paydesk-form")[0].reset();
            } else {
                $('#output').removeClass('success').addClass('failure');
            }

            console.log("Ajax request succeeded. Payment succeded.");
        };

        $('.buy').on('click', function() {
            var id = $(this).attr('id');

            $.ajax({
                type: 'post',
                url: 'shop.php?action=add',
                data: {
                    item: id
                },
                dataType: 'json',
                success: function(data) {
                    updateCart(data);
                    console.log('Ajax request succeeded. Item with id: ' + id + " is added to cart.");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                },
            });
        });

        $('.clear').on('click', function() {
            $.ajax({
                type: 'post',
                url: 'shop.php?action=clear',
                dataType: 'json',
                success: function(data) {
                    updateCart(data);
                    console.log('Ajax request succeeded. Cart cleared.');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                },
            });
        });


        $('#paydesk-form').on('submit', function(event) {
            event.preventDefault();
            $('#output').removeClass().addClass('working').html('<img src="img/progress/progress.gif" height="40" width="40"/> Processar betalningen, var vänligen vänta...');
            $.ajax({
                type: 'post',
                url: 'checkout.php?action=payment',
                data: $('#paydesk-form').serialize(),
                dataType: 'json',
                success: function(data) {
                    updatePayDesk(data);
                    console.log("Ajax request succeeded. Payment succeeded.");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        });

        if (document.location.pathname.match(/[^\/]+$/)[0] === 'paydesk.php') {
            $.ajax({
                type: 'post',
                url: 'checkout.php?action=getTotalSum',
                dataType: 'json',
                success: function(data){
                    $('#payment-amount').html(data.totalSum);
                    console.log('Ajax request succeeded. Total sum fetched: ' + data.totalSum);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        }

        if (document.location.pathname.match(/[^\/]+$/)[0] === 'shop-index.php') {
            initCart();
        }
    }
}) (jQuery);
