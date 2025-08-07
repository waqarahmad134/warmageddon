$(".favourit").css("cursor",'pointer')
function Favorite(id) {
    var url =$("#url").val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'GET',
        url: url+'/user/favorite-game/'+id,
        success:function (data) {

          if (data.success) {
            $(`.game_fav${id}`).addClass("fav-active")
            toastr.success('Game successfully added to favorites',{
              closeButton:true,
              progressBar:true,
          });
          }
          if (data.delete) {
            $(`.game_fav${id}`).removeClass("fav-active")
            toastr.error('Game removed from favorites',{
              closeButton:true,
              progressBar:true,
          });
          }
          if (data.error) {
            toastr.error('something went wrong');
          }

        },
        error:function(error){
        }
    });
}

