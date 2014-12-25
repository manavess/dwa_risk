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
              <a href="<?php echo @base64_encode($gallery['Gallery']['name']);?>" rel="lightbox[plants]" title="Click on the right side of the image to move forward."><img src="data:image/jpeg;base64, <?php echo @base64_encode($gallery['Gallery']['name']);?>" alt="Plants: image 1 0f 4 thumb" width="140" height="140" /></a>
              <?php endforeach;?>
       
  		</div>
      <div class="single">
  		  <a href="gallery/image-2.jpg" rel="lightbox[plants]" title="Alternately you can press the right arrow key." ><img src="gallery/thumb-2.jpg" alt="Plants: image 2 0f 4 thumb" width="140" height="140" /></a>
      </div>
      <div class="single">
  		  <a href="gallery/image-3.jpg" rel="lightbox[plants]" title="The script preloads the next image in the set as you're viewing."><img src="gallery/thumb-3.jpg" alt="Plants: image 3 0f 4 thumb" width="140" height="140" /></a>
      </div>
      <div class="single">
  		  <a href="gallery/image-4.jpg" rel="lightbox[plants]" title="The script preloads the next image in the set as you're viewing."><img src="gallery/thumb-4.jpg" alt="Plants: image 3 0f 4 thumb" width="140" height="140" /></a>
      </div>
      <div class="single">
  		  <a href="gallery/image-5.jpg" rel="lightbox[plants]" title="The script preloads the next image in the set as you're viewing."><img src="gallery/thumb-5.jpg" alt="Plants: image 3 0f 4 thumb" /></a>
      </div>
      <div class="single last">
  		  <a href="gallery/image-6.jpg" rel="lightbox[plants]" title="Click the X or anywhere outside the image to close"><img src="gallery/thumb-6.jpg" alt="Plants: image 4 0f 4 thumb" /></a>
      </div>
  	</div>
  </div>
  <div class="imageRow">
  	<div class="set">
  	  <div class="single first">
  		  <a href="gallery/image-7.jpg" rel="lightbox[plants]" title="Click on the right side of the image to move forward."><img src="gallery/thumb-7.jpg" alt="Plants: image 1 0f 4 thumb" width="140" height="140" /></a>
  		</div>
      <div class="single">
  		  <a href="gallery/image-8.jpg" rel="lightbox[plants]" title="Alternately you can press the right arrow key." ><img src="gallery/thumb-8.jpg" alt="Plants: image 2 0f 4 thumb" width="140" height="140" /></a>
      </div>
      <div class="single">
  		  <a href="gallery/image-9.jpg" rel="lightbox[plants]" title="The script preloads the next image in the set as you're viewing."><img src="gallery/thumb-9.jpg" alt="Plants: image 3 0f 4 thumb" width="140" height="140" /></a>
      </div>
      <div class="single">
  		  <a href="gallery/image-10.jpg" rel="lightbox[plants]" title="The script preloads the next image in the set as you're viewing."><img src="gallery/thumb-10.jpg" alt="Plants: image 3 0f 4 thumb" width="140" height="140" /></a>
      </div>
      <div class="single">
  		  <a href="gallery/image-11.jpg" rel="lightbox[plants]" title="The script preloads the next image in the set as you're viewing."><img src="gallery/thumb-11.jpg" alt="Plants: image 3 0f 4 thumb" width="150" height="150" /></a>
      </div>
      <div class="single last">
  		  <a href="gallery/image-12.jpg" rel="lightbox[plants]" title="Click the X or anywhere outside the image to close"><img src="gallery/thumb-12.jpg" alt="Plants: image 4 0f 4 thumb" /></a>
      </div>
  	</div>
  </div>
    </div>
</div>   
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Image'), array('action' => 'add')); ?></li>
    </ul>
</div>
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
