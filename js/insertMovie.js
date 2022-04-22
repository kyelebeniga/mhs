$(document).ready(function(){
    $("form").on("submit", function(e){
        e.preventDefault();

        var title = $('#movie_title').val();
        var year = $('#movie_year').val();
        var rating = $('#movie_rating').val();
        var desc = $('#movie_desc').val();
        var duration = $('#movie_duration').val();
        var price = $('#movie_price').val();
        var poster = $('#image-file').val();
        var banner = $('#image-banner').val();

        if(title == ''){
            $('#movie_title').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(year == ''){
            $('#movie_year').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(rating == ''){
            $('#movie_rating').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(desc == ''){
            $('#movie_desc').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(duration == ''){
            $('#movie_duration').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(price == ''){
            $('#movie_price').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(poster == ''){
            $('#poster-label').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else if(banner == ''){
            $('#label-banner').notify('Field is empty.',{
                    position: 'right'
                }
            );
        }
        else{ 
            $.ajax({
                url: "php/insertMovie.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $(".movie-table").load(location.href + " .movie-table");
                    $.notify('Success!', {position:"bottom right",className:"success"});
                    $("#movieForm")[0].reset();
                    closeForm();
                }
            });
        }
    });
});