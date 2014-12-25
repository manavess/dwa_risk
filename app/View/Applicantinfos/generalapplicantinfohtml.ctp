<ul class="breadcrum breadcrum1"><li><?php echo $this->Html->addCrumb('Admission >>','#'); ?>      
		&nbsp;&nbsp;Applicant info</li></ul>
		
    <div id="container">
        <div id="leftbody"> <a href="#"><img width="200" height="140" alt="" src="<?php echo $this->webroot; ?>img/demo/mission.png"></a> <br class="clear">
        </div>
        <div id="rightbody">
            <h1>Applicant Information</h1>
            <?php if(!empty($applicantinfo)) { echo $applicantinfo['Applicantinfo']['pagetext'];} ?>
        </div>
        <br class="clear">
    </div>

</div>
