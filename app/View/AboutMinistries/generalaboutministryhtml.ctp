<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('About us','generalaboutministryhtml'); ?>      
    </li></ul>
&nbsp;
<div id="container">


    <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/200x1404.gif"></a> <br class="clear">
    </div>
    <div id="rightbody">
        <h1>About Us</h1>
            <?php if(!empty($aboutMinistry['AboutMinistry']['about_us'])){ echo $aboutMinistry['AboutMinistry']['about_us']; }?>
        <br class="clear">
    </div>
    <br class="clear">
</div>