$(document).ready(function(){
    $("form").on("submit", function(e){
        e.preventDefault();

        $.ajax({
            url: "php/insertMovie.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                console.log(data);
                $(".movie-table").load(location.href + " .movie-table");
                $.notify('Success!', {position:"top center",className:"success"});
                closeForm();
            }
        });
    });
});