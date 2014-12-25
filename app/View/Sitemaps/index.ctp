<?php ?>
<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Sitemap','#'); ?>      
		</li></ul>
		&nbsp;
  <div id="container">
    <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/200x1404.gif"></a> <br class="clear">
        </div>
    <div id="rightbody" class="sitemap">
      <h1>Sitemap</h1>
      <ul>
      
      <?php  foreach($menus as $menukey=>$val){  ?>
      <div>
      <?php echo $menukey; ?>
      
      <?php  foreach($val as $key=>$value):?>
     
      
      <li style="margin:12px 64px;indent-left:20px;"><a href="<?php echo $this->webroot.$value['url'];?>"><?php echo $key;?></a></li>
      <?php endforeach;?>
     </div>
     <?php } ?></ul>
      <br class="clear">
    </div>
    <br class="clear">
  </div>
</div>
