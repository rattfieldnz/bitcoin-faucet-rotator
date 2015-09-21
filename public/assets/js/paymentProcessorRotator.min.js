/**
 * Created by robattfield on 28-Aug-2015.
 */
$(function(){

    var clickCount = 0;
    var slug = $("#faucet_slug").attr('property');

    $.ajax('/api/v1/payment_processors/' + slug + '/faucets', {
        success: function(data) {
            //set first url upon first view
            var arr = $.map(data, function(el) { return el; });
            $('#rotator-iframe').attr('src', arr[0].url);
            $('#current').attr('href', '/faucets/' + arr[0].slug);

            //Set iframe src to first faucet in array
            $('#first_faucet').click(function(event) {
                event.preventDefault();
                $('#rotator-iframe').attr('src', arr[0].url);
                $('#current').attr('href', '/faucets/' + arr[arr.length + clickCount].slug);
            });

            $('#next_faucet').click(function(event) {
                event.preventDefault();
                clickCount += 1;

                if(clickCount > arr.length - 1) {
                    $('#rotator-iframe').attr('src', arr[0].url);
                    $('#current').attr('href', '/faucets/' + arr[0].slug);
                }
                else{
                    $('#rotator-iframe').attr('src', arr[clickCount].url);
                    $('#current').attr('href', '/faucets/' + arr[clickCount].slug);
                }
            });

            $('#previous_faucet').click(function(event) {
                event.preventDefault();
                clickCount -= 1;

                if(clickCount <= 0) {
                    //If click count is negative, start at end of faucets array and
                    //work way backwards.
                    $('#rotator-iframe').attr('src', arr[arr.length + clickCount].url);
                    $('#current').attr('href', '/faucets/' + arr[arr.length + clickCount].slug);
                }else{
                    $('#rotator-iframe').attr('src', arr[clickCount].url);
                    $('#current').attr('href', '/faucets/' + arr[clickCount].slug);
                }
            });

            $('#last_faucet').click(function(event) {
                event.preventDefault();
                clickCount = arr.length - 1;
                $('#rotator-iframe').attr('src', arr[clickCount].url);
                $('#current').attr('href', '/faucets/' + arr[clickCount].slug);
            });

            $('#reload_current').click(function(event) {
                event.preventDefault();
                //$('#rotator-iframe').contentWindow.location.reload(true);
                $('#rotator-iframe').attr('src', arr[clickCount].url);
            });

            $('#random').click(function(event) {
                event.preventDefault();
                var min = 0;
                var max = arr.length - 1;
                var randomFaucetIndex = randomInt(min, max);
                $('#rotator-iframe').attr('src', arr[randomFaucetIndex].url);
            });
        }
    });
});

function randomInt(min, max)
{
    return Math.floor(Math.random() * (max - min + 1) + min);
}
