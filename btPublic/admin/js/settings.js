// JavaScript Document

function updateModuleSettings(ID, BASE_URL){
	
	var new_value = null;
	var old_value = null;
	
	if(document.getElementById(ID).checked){
		
		new_value = 'YES';
		old_value = 'NO';
	}
	else{
		
		new_value = 'NO';
		old_value = 'YES';	
	}
		
	location.href = BASE_URL+'admin/settings/updateModuleInfo/'+ID+'/'+new_value+'/'+old_value;
}