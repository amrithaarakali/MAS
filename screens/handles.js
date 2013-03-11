
var likeval=0;
var unlikeval=0;

$(document).ready(function(){

      $('#yea').click(function() {
        likeval++;
        $.ajax({
            type : "POST",
            cache: false,
            url : "vote.php",
            data:{
                likeval:likeval
            },
            success: function() {},
            error : function() {
                alert("Sorry, The requested property could not be found.");
            }
        });
    });

    $('#nay').click(function() {
        unlikeval++;
        $.ajax({
            type : "POST",
            cache: false,
            url : "vote.php",
            data:{
                unlikeval:unlikeval
            },
            success: function() {},
            error : function() {
                alert("Sorry, The requested property could not be found.");
            }
        });
    });
});