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
                $('#movie_title2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(year == ''){
                $('#movie_year2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(rating == ''){
                $('#movie_rating2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(desc == ''){
                $('#movie_desc2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(duration == ''){
                $('#movie_duration2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(price == ''){
                $('#movie_price2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(poster == ''){
                $('#poster-label2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
            }
            else if(banner == ''){
                $('#label-banner2').notify('Field is empty.',{
                        position: 'right'
                    }
                );
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