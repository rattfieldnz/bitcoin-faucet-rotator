$(function(){

    var clickCount = 0;
    $.ajax('http://faucet_rotator.dev:8888/api/v1/faucets', {
        success: function(data) {
            //set first url upon first view
            var arr = $.map(data, function(el) { return el; });
            $('#rotator-iframe').attr('src', arr[0].url);
            $('#current').attr('href', arr[0].url);

            //Set iframe src to first faucet in array
            $('#first_faucet').click(function(event) {
                event.preventDefault();
                $('#rotator-iframe').attr('src', arr[0].url);
                $('#current').attr('href', arr[arr.length + clickCount].url);
            });

            $('#next_faucet').click(function(event) {
                event.preventDefault();
                clickCount += 1;

                if(clickCount > arr.length - 1) {
                    $('#rotator-iframe').attr('src', arr[0].url);
                    $('#current').attr('href', arr[0].url);
                }
                else{
                    $('#rotator-iframe').attr('src', arr[clickCount].url);
                    $('#current').attr('href', arr[clickCount].url);
                }
            });

            $('#previous_faucet').click(function(event) {
                event.preventDefault();
                clickCount -= 1;

                if(clickCount <= 0) {
                    //If click count is negative, start at end of faucets array and
                    //work way backwards.
                    $('#rotator-iframe').attr('src', arr[arr.length + clickCount].url);
                    $('#current').attr('href', arr[arr.length + clickCount].url);
                }else{
                    $('#rotator-iframe').attr('src', arr[clickCount].url);
                    $('#current').attr('href', arr[clickCount].url);
                }
            });

            $('#last_faucet').click(function(event) {
                event.preventDefault();
                clickCount = arr.length - 1;
                $('#rotator-iframe').attr('src', arr[clickCount].url);
                $('#current').attr('href', arr[clickCount].url);
            });

            $('#reload_current').click(function(event) {
                event.preventDefault();
                $('#rotator-iframe').attr('src', arr[clickCount].url);
            });
        }
    });
});