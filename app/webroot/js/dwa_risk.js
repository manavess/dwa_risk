/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $('input[type=text]').bind('keyup', function() {
        if(!$(this).hasClass('lower')){
        var val = $(this).val().toUpperCase();
        if ($(this).attr('lower') !== '1')
            $(this).val(val);
    }
    });
});

function previewImages() {
    var fileList = this.files;

    var anyWindow = window.URL || window.webkitURL;

    for (var i = 0; i < fileList.length; i++) {
        //get a blob to play with
        var objectUrl = anyWindow.createObjectURL(fileList[i]);
        // for the next line to work, you need something class="preview-area" in your html
        $('.photo-area').html('<img height="120" width="120" src="' + objectUrl + '" />');
        // get rid of the blob
        window.URL.revokeObjectURL(fileList[i]);
    }


}





