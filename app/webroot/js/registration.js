//Automatic Uploader
$(document).ready(function()
{
    $('#photo_uploads').live('change', function()
    {alert('hi');
        $("#student_registration").vPB({
            url: 'vasPLUSfileUploads.php',
            beforeSubmit: function()
            {
                $("#photo-area").show();
                $("#photo-area").html('');
                $("#photo-area").html('<div style="font-family: Verdana, Geneva, sans-serif; font-size:12px; color:black;" align="center">Upload <img src="images/loadings.gif" align="absmiddle" alt="Upload...." title="Upload...."/></div><br clear="all">');
            },
            success: function(response)
            {
                $("#photo-area").hide().fadeIn('slow').html(response);
            }
        }).submit();
    });
    
 
}); 
