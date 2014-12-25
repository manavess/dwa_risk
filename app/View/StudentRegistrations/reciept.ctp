<?php echo $this->Html->script('jquery.js'); ?>

<ul class="breadcrum"><li><?php echo $this->Html->addCrumb('Admission >>', '#'); ?>      
        &nbsp;&nbsp;&nbsp; Admission Receipt</li></ul>

<div class="studentRegistrations form" id="formelement">
        <form id="studentregistration" action="" method="post">
        <?php echo $this->Form->create('StudentRegistration'); ?>
        <fieldset>
            <div class='heading'><?php echo __('DIRECTORATE OF ADMISSION, EVALUATION & AUTHENTICATION'); ?><br /><br /><span><?php echo __('RECEIPT OF APPLICATION '); ?></span><br /><br /><?php echo __('ACADEMIC YEAR ' . date('Y') . '/' . date('Y', strtotime('+1 year'))); ?></div>
            <div class="form-area2">
                <div class="left-area">
                    <table cellpadding="3" cellspacing="0"  width="100%" >
                        <tr>

                            <td width="50%" align="left" class="receipt"> Applicant Name: </td>
                            <td width="50%" align="left" class="receipt" ><?php echo $studentRegistration['StudentRegistration']['applicant_name']; ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt"> Application Number: </td>
                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt" ><?php echo $studentRegistration['StudentRegistration']['application_number']; ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" class="receipt"> Receipt Number: </td>
                            <td width="50%" align="left" class="receipt" ><?php echo $studentRegistration['StudentRegistration']['id']; ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt"> Year: </td>
                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt" ><?php echo date('Y'); ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" class="receipt"> Number of Choices: </td>
                            <td width="50%" align="left" class="receipt" ><?php echo $studentRegistration['StudentRegistration']['numberofchoice']; ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt"> Certificate Index: </td>
                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt" ><?php echo $studentRegistration['StudentRegistration']['certificate_index']; ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" class="receipt"> Date Of Certificate: </td>
                            <td width="50%" align="left" class="receipt"><?php echo $studentRegistration['StudentRegistration']['date_of_certificate']; ?></td>
                        </tr>
                        <tr>

                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt"> Application Fees: </td>
                            <td width="50%" align="left" bgcolor="#F8F7DF" class="receipt"><?php
                                if (!empty($fees['AdminPreference']['fees'])) {
                                    echo $fees['AdminPreference']['fees'] . ' Sudanese Pounds';
                                }
                                ?></td>
                        </tr>

                    </table>

                </div>
                <div class="right-area"> 

<!--                    <label style="width:90%;" class="receipt">Course Name: &nbsp;&nbsp;<?php //echo $studentRegistration['StudentRegistration']['coursename']; ?></label><br><br>-->

                    <div style="width:90%;">
                        <label>Prefered Colleges</label>
                        <table style="width:90%;">
                            <tr>
                            <br>
                            </tr>
                            <tr>
                                <th><?php echo __('Choice Number '); ?></th>
                                <th><?php echo __('College code '); ?></th>
                                <th><?php echo __('College'); ?></th>
                                <th><?php echo __('University'); ?></th></tr>
                            <?php $i=1;  foreach ($collegedata as $value) { ?> 
                            <tr>
                                        <td><?php echo $i; ?></td>
                                    <td><?php echo $value['collegecode']; ?>
                                    <td><?php echo $value['collegename']; ?>
                                    <td><?php echo $this->StdRegistrations->getuniversity($value['universityid']); ?></td>
                                </tr>
                            <?php $i++;}
                            ?>
                        </table>
                    </div>

                    <!--                    <div><label>Application Fees : </label><?php
                    //if (!empty($fees['AdminPreference']['fees'])) {
                    //  echo $fees['AdminPreference']['fees'] . ' Sudanese Pounds';
                    // }
                    ?></div>-->

                </div>
                <div><label style="width:90%;" class="receipt">Signature: </label><?php echo $this->Html->image('DummySign.png'); ?></div>
                <div><lable style="width:90%;" class="receipt">Signature of Applicant:</lable></div>
                <div>
                    <p>*This is a computer generated receipt. The Student has to present this receipt to the office for obtaining results and any other enquiries.</p>
                        <div style="text-align:center;"><strong>We wish you all the best!</strong></div>
                </div>
            </div>
        </fieldset>
        <div id="form-button"><?php echo $this->Form->end(__('Print', array('id' => 'printbox'))); ?></div>
    </form>
</div>

<script>
    $('#form-button').click(function() {
        var formelement = $("#formelement").html();
        Popup($("#formelement").html());

        return false;
    });

    function Popup(data)
    {
        var mywindow = window.open('', 'Receipt', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Receipt</title>');
        /*optional stylesheet*/ 

        mywindow.document.write('</head><body><img src="<?php echo $this->webroot; ?>img/demo/logo00.png" width="83" height="70">&nbsp;&nbsp;<img src="<?php echo $this->webroot; ?>img/demo/logo12.png" width="267">');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.focus();

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
