<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('About Us >>','/Abouts/generalaboutushtml'); ?>      
        &nbsp;&nbsp;Vision</li></ul>
<div id="container">
    <div id="leftbody">
        <a href="#">
            <img width="200" height="140" alt="" src="<?php echo $this->webroot;?>img/demo/vision.png">
        </a> 
        <br class="clear">
    </div>
    <div id="rightbody">
        <h1>Vision</h1>
        <p><?php if(!empty($vision)){ echo $vision['Vision']['vision'];} ?></p>
        <br class="clear">
    </div>
    <br class="clear">
</div>

