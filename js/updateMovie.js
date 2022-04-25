$(document).ready(function(){
    $(document).on('click', 'a[role=update]', function(e){
        e.preventDefault();
        var id = $(this).data("id");

        updateForm();

        $("#formUpdate").on("submit", function(){
            var title = $('#movie_title2').val();
            var year = $('#movie_year2').val();
            var rating = $('#movie_rating2').val();
            var desc = $('#movie_desc2').val();
            var duration = $('#movie_duration2').val();
            var price = $('#movie_price2').val();
            var poster = $('#image-file2').val();
            var banner = $('#image-banner2').val();
            
            var fd = new FormData(this);
            fd.append('id', id);

            if(title == ''){
                $('#movie_title2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(year == ''){
                $('#movie_year2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(rating == ''){
                $('#movie_rating2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(desc == ''){
                $('#movie_desc2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(duration == ''){
                $('#movie_duration2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(price == ''){
                $('#movie_price2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(poster == ''){
                $('#poster-label2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else if(banner == ''){
                $('#label-banner2').css({
                    "box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-webkit-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)",
                    "-moz-box-shadow": "0px 0px 10px 2px rgba(255,72,72,0.75)"
                });
            }
            else{
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
            }
        });
    })
});