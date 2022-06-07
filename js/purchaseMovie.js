$(document).ready(function(){
    $(".btn").click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var dataString = $("#myForm").serialize() + '&movieid=' + id;
        var firstName = $("#first_name").val();
        var lastName = $("#last_name").val();
        var seat = $("#seats").val();
        if(firstName == ''){
            $('#first_name').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(lastName == ''){
            $('#last_name').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(seat == ''){
            $('#seats').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else{
            $.ajax({
                url: "php/purchaseMovie.php",
                type: "POST",
                data: dataString,
                success: function(data){
                    $.notify('Ticket Purchased! Redirecting...', {position:"bottom right",className:"success"});
                    setTimeout(function() {
                        window.location.href = "history.php";
                    }, 2000);
                }
            });
        }
    });
});