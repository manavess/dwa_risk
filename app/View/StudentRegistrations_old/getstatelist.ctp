<?php
 $option = '<option value=""> Select </option>';
foreach( $states as  $key => $value ){	
	 $option .= "<option value='{$key}' > {$value}  </option> ";     
}
echo $option; 

?>
