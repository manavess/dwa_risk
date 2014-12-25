<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('About Us >>','/Abouts/generalaboutushtml'); ?>      
     &nbsp;Overview</li></ul>
  
    <div id="container">
    
        <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/overview.png"></a> <br class="clear">
        </div>
        <div id="rightbody">
            <h1>Overview</h1>
            <p><?php if(!empty($overviews)) {echo $overviews['Overview']['overview'];} ?></p>
            <br class="clear">
        </div>
        <br class="clear">
    </div>
</div>
