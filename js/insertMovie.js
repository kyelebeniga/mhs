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
            $('#movie_title').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(year == ''){
            $('#movie_year').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(rating == ''){
            $('#movie_rating').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(desc == ''){
            $('#movie_desc').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(duration == ''){
            $('#movie_duration').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(price == ''){
            $('#movie_price').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(poster == ''){
            $('#poster-label').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else if(banner == ''){
            $('#label-banner').css({
                "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
            });
        }
        else{ 
            $.ajax({
                url: "insertMovie.php",
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