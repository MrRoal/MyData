$(document).ready(function() {
    $("#iGenreId").change(function() {
        var _iGenreId = $('#iGenreId').val();
        url = base_url+"admin/musicmanagement/getPlaylistByiGenreId/"+_iGenreId;
          $.post(url,
                function(data) {
                    var _iPlaylistId = $.parseJSON(data);
                    $('#iPlayListId').html(_iPlaylistId);                    
                });
    });

});