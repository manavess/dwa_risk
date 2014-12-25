$('#addstudentregistration').validate();

$('#datepicker').rules('add',
{							
	required:true,
	date:false,
	messages:{
	required:'Date of birth should not be empty'
}});

$('#datepicker1').rules('add',
{							
	required:true,
	date:false,
	messages:{
	required:'Date of certificate should not be empty'
}});

$('#datepicker2').rules('add',
{							
	required:true,
	date:false,
	messages:{
	required:'Nationality issue date should not be empty'
}});

$('#datepicker4').rules('add',
{							
	required:true,
	date:false,
	messages:{
	required:'Guardian nationality issue date should not be empty'
}});

$('#datepicker5').rules('add',
{							
	//required:function(element){
		//alert($(element).val());
	//},
	required:true,
	date:false,
	messages:{
	required:'Birth Certificate issue date should not be empty'
}});

/*$('#compamyname').rules('add',
{							
	required:true,

	messages:{
	required:'Company name should not be empty'
}});


$('#isworking').rules('add',
{							
	required:false,
	messages:{
	required:'Company Name should not be empty'
}});*/
$('#address').rules('add',
{							
	required:true,
	//date:false,
	messages:{
	required:'Address should not be empty'
}});
$('#workexp').rules('add',
{							
	required:true,
	//date:false,
	messages:{
	required:'Work Experience should not be empty'
}});





