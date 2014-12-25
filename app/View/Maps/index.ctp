<?php
echo $this->html->css('lightbox.css');
echo $this->html->script('lightbox.js');
?>

<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Maps','#'); ?>      
		&nbsp;</li></ul>
		
    <div id="container">
        <div id="leftbody"> <a href="#"><img src="img/demo/200x1404.gif" alt="" /> <br class="clear" />
        </div>
        <div id="rightbody">
            <h1>Location On Map</h1>
            <p> <div style="width: 600px">
                <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=+&amp;q=juba+south+sudan&amp;ie=UTF8&amp;hq=&amp;hnear=Juba,+Bahr+al+Jabal,+Central+Equatoria,+South+Sudan&amp;ll=4.85,31.6&amp;spn=0.001358,0.001725&amp;t=m&amp;z=14&amp;iwloc=lyrftr:m,2439298814217901940,4.853706,31.584181&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=+&amp;q=juba+south+sudan&amp;ie=UTF8&amp;hq=&amp;hnear=Juba,+Bahr+al+Jabal,+Central+Equatoria,+South+Sudan&amp;ll=4.85,31.6&amp;spn=0.001358,0.001725&amp;t=m&amp;z=14&amp;iwloc=lyrftr:m,2439298814217901940,4.853706,31.584181" style="color:#0000FF;text-align:left">View Larger Map</a></small>
<!--                <span style="font-size: 9px;">
                    <a href="http://www.regiohelden.de/google-maps/" style="font-size: 9px;"></a>  <a href="http://www.regiohelden.de/" style="font-size: 9px;"></a>
                </span>-->
</div></p>
            <br class="clear" />
        </div>
        <br class="clear" />
    </div>
</div>
