/**
 * Created by robattfield on 28-Jun-2015.
 */

function faucets(){

    var faucets = [];
    $.getJSON('/api/v1/faucets', function(data){
        for(var i = 0; i , data.length; i++){
            console.log(data[i]);
        }
    });
    return faucets;
}

function getFaucets(){

    for(var i = 0; i < faucets().length; i++){
        console.log(faucets()[i]);
    }
}

$(function(){

    //getFaucets();
    faucets();

});