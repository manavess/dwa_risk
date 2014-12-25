<ul class="breadcrum breadcrum1 "><li><?php echo $this->Html->addCrumb('Contact Us >>','#'); ?>      
		Contact Details</li></ul>
		
    <div id="container">
        <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/200x1404.gif"></a> <br class="clear">
        </div>
        <div id="rightbody">
            <h1>Contact Details</h1>
            <?php if(!empty($contact)){echo $contact['ContactDetail']['pagetext'];} ?>
        </div>
        <br class="clear">
    </div>