<ul class="breadcrum breadcrum1"><li><?php echo $this->Html->addCrumb('Admission >>','#'); ?>      
        Admission Guide</li></ul>

<div id="container">
    <div id="leftbody"> 
        <a href="#">
            <img width="200px" height="140" src="data:image/jpeg;base64, <?php echo base64_encode($admissionGuide['AdmissionGuide']['image']);?>" /> 
        </a>
        <br class="clear">
    </div>
    <div id="rightbody">
        <div class="submit" style="float:right; margin-top:-20px;"><a href="downloadadmissionguide" target="_blank"><h1>View Admission Guide</h1></a>&nbsp;
       <!--- <a href="<?php //echo $this->webroot;?>download/admission_guidelines.doc" target="_blank"><h1>Read Admission Guide</h1></a> --->

        </div>
        <h1>Admission Guide</h1>

     <?php echo $admissionGuide['AdmissionGuide']['admission_guide']; ?>
    </div>
    <br class="clear">
</div>
</div>
