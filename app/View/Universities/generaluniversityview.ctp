<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('University','#'); ?>      
    </li></ul>
&nbsp;
<div id="container">

          <?php foreach ($universities as $university) {  ?>

    <div  id="leftbody">
                    <?php if(!empty($university['University']['image'])) {?>  
        <img width="140" height="100" src="data:image/jpeg;base64, <?php echo @base64_encode($university['University']['image']);?>" />
                    <?php } ?>
    </div>
    <div id="rightbody">
        <div>
            <table style="width:100%!important;">

                <tr>
                    <td width="30%" valign="top" align="left" colspan="4"><strong><?php echo $university['University']['name']; ?></strong></td>
                    <td width="60%" valign="top" align="left">&nbsp;</td>
                    <td width="5%" valign="top" align="left">&nbsp;</td>
                    <td width="5%" valign="top" align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="30%" valign="top" align="left" class="td-txt">
                        <strong>City :</strong><br>
                        <strong>State :</strong><br>
                        <strong>Contact Person:</strong><br>
                        <strong>Contact No:</strong><br>
                        <strong>Email:</strong><br>
                        <strong>Web site:</strong><br>

                    </td>
                    <td width="70%" valign="top" align="left" colspan="3" class="td-txt">
                                    <?php echo $university['City']['name']; ?><br>
                                    <?php echo $university['State']['name']; ?><br>
                                    <?php echo $university['University']['contact_person']; ?> <br>
                                    <?php echo $university['University']['contact_no']; ?><br>
                                    <?php echo strtolower($university['University']['email_id']); ?><br>
                                    <?php echo $university['University']['website']; ?>
                    </td>
                <tr>
                    <td valign="top" align="left" colspan="4">&nbsp;</td>
                </tr>
                </tr>
            </table>
        </div>
    </div>

</div>

    <?php } ?>
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-54651553-1', 'auto');
    ga('send', 'pageview');

</script>