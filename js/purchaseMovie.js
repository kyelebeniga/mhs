$(document).ready(function(){
    $(".btn").click(function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var dataString = $("#myForm").serialize() + '&movieid=' + id;
        var firstName = $("#first_name").val();
        var lastName = $("#last_name").val();
        var seat = $("#seats").val();
        if(firstName == ''){
            $('#first_name').notify('Field is empty.',{
                    position: 'bottom'
                }
            );
        }
        else if(lastName == ''){
            $('#last_name').notify('Field is empty.',{
                    position: 'bottom'
                }
            );
        }
        else if(seat == ''){
            $('#seats').notify('Field is empty.',{
                    position: 'bottom'
                }
            );
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