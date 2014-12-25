<ul class="breadcrum breadcrum1"><li><?php echo $this->Html->addCrumb("Management >>",'#'); ?>      
		&nbsp;&nbsp;&nbsp;Director's word </li></ul>
		
    <div id="container">
    
        <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/president_message.png"></a> <br class="clear">
        </div>
        <div id="rightbody">
            <h3>Director General of Admission's Words</h3>
            <?php echo $directorWord['DirectorWord']['director_word']; ?>
        </div>
        <br class="clear">
    </div>
</div>
