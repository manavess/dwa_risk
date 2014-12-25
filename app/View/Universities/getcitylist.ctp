<?php $option = '<option value="">Select</option>';
foreach( $cities as  $key => $value ){	
	$option .= "<option value='{$key}'>{$value}</option>";     
}

echo $option; 
?>
