<?php ?>
<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Notice','#'); ?>      
		&nbsp;</li></ul>
		
  <div id="container">
    <div id="leftbody"><a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot;?>img/demo/200x1404.gif"></a> <br class="clear">
    </div>
    <div id="rightbody">
      <h3>Notices</h3>
      <p><?php if(!empty($notice)){ echo $notice['Notice']['notice'];} ?></p>
      <br class="clear">
    </div>
    <br class="clear">
  </div>
</div>
