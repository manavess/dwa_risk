<?php
echo $this->html->css('lightbox.css');
echo $this->html->script('lightbox.js');
?>


<?php if(!$loggedIn) { ?>

     <ul class="breadcrum"><li><?php echo $this->Html->addCrumb('About Us >>','/Abouts/generalaboutushtml'); ?>       
     &nbsp;Gallery</li></ul>
  
 <?php }else{ 
 echo $this->Html->addCrumb('Gallery', '/Galleries');
 }?>
<div id="container-wrapper">

<div class="Galleries index">
    <div class="imageRow">
  	<div class="set">
  	  <div class="single first">
              <?php foreach($galleries as $gallery):  ?>
                <a href="<?php echo $this->webroot."app/webroot/gallery/".$gallery['Gallery']['name']; ?>" rel="lightbox[plants]" title="Alternately you can press the right arrow key." ><img src="<?php echo $this->webroot."app/webroot/gallery/".$gallery['Gallery']['name']; ?>" alt="Plants: image 2 0f 4 thumb" width="140" height="140" /></a> 
            <?php if($loggedIn) { ?>    <?php echo $this->Form->postLink($this->Html->image('close.png'), array('action' => 'delete', $gallery['Gallery']['id']), array('escape' => false,'title'=>'Delete'), __('Are you sure you want to delete # %s?', $gallery['Gallery']['id'])); ?> <?php } ?>
             <?php endforeach;?>
       
  		</div>
      
  
    </div>
</div>   
</div>
<?php if($loggedIn) { ?>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Image'), array('action' => 'add')); ?></li>
    </ul>
</div>
<?php } ?>
   <script>

  jQuery(document).ready(function($) {
      $('a').smoothScroll({
        speed: 1000,
        easing: 'easeInOutCubic'
      });

      $('.showOlderChanges').on('click', function(e){
        $('.changelog .old').slideDown('slow');
        $(this).fadeOut();
        e.preventDefault();
      });
  });
</script>
