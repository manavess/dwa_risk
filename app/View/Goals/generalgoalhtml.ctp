<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('About Us >>','/Abouts/generalaboutushtml'); ?>       
     &nbsp;Goal</li></ul>
  
    <div id="container">
  
        <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/goal.png"></a> <br class="clear">
        </div>
        <div id="rightbody">
            <h1>Goals</h1>
            <?php if(!empty($goal['Goal']['goal'])){ echo $goal['Goal']['goal'];} ?>
        </div>
        <br class="clear">
    </div>
</div>
