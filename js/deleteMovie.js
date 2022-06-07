$(document).on('click', '.deleteBtn', function(){
    var path = $(this).attr("id");
    
    $.ajax({
        url: "php/deleteMovie.php",
        method: "POST",
        data: {path:path},
        success: function(data){
            $(".movie-table").load(location.href + " .movie-table");
            $.notify('Movie deleted.', {position:"bottom right"});
        }
    })
})