$(document).ready(function(){
    $(document).on('click', 'a[role=update]', function(e){
        e.preventDefault();
        var id = $(this).data("id");

        updateForm();

        $("#formUpdate").on("submit", function(){
            var fd = new FormData(this);
            fd.append('id', id);
            $.ajax({
                url: "php/updateMovie.php",
                type: "POST",
                data: fd,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $(".movie-table").load(location.href + " .movie-table");
                    $.notify('Movie updated!', {position:"bottom right",className:"success"});
                    $("#formUpdate")[0].reset();
                    closeUpdateForm();
                }
            });
        });
    })
});