// JavaScript Document

function validateInfo(){
	
	if(document.getElementById('name').value == 'Enter agent name.'){
		
		document.getElementById('name').value = '';
			
	}
	
	if(document.getElementById('userName').value == 'Enter user name.'){
		
		document.getElementById('userName').value = '';
			
	}
	
	if(document.getElementById('email').value == 'Enter email address.'){
		
		document.getElementById('email').value = '';
			
	}
	
	if(document.getElementById('phone').value == 'Enter phone number.'){
		
		document.getElementById('phone').value = '';
			
	}
	
	if(document.getElementById('address').value == 'Enter address.'){
		
		document.getElementById('address').value = '';
			
	}
			
}

function claerMessage(){
	
	document.getElementById('nameError').innerHTML = '';
	document.getElementById('userNameError').innerHTML = '';
	document.getElementById('passwordError').innerHTML = '';
	document.getElementById('CpasswordError').innerHTML = '';
	document.getElementById('emailError').innerHTML = '';
}



function deleteEntry(remove_URL){
	
	if(confirm("Are you really want to delete this agent!")){
		
		location.href = remove_URL;
	}
}


function genralActions(baseUrl, page){		
	
	var totalRows = document.getElementById('counter_number').value;
	
	if(document.getElementById('CB_all').checked){
		for(var i=1; i<=totalRows; i++){
			ID = 'CB'+i;
			document.getElementById(ID).checked = true;
		}
	}
	else{
		for(var i=1; i<=totalRows; i++){
			ID = 'CB'+i;
			document.getElementById(ID).checked = false;
		}
	}
}


function performAction(actionType){
	
	var totalRows = document.getElementById('counter_number').value;	
	var valid = false;
	
	for(var i=1; i<=totalRows; i++){
		ID = 'CB'+i;
		if(document.getElementById(ID).checked == true){
			valid = true;
			break;
		}
	}
	
	if(valid){
		document.getElementById('actionType').value = actionType;
		document.getElementById("FRM_ACTIVE_ALL").submit();
	}
	else{
		alert('You need to select atleast one item to perform this operation!');	
	}
}



function changeRecordsPerPage(base_url){
	
	var recordsPerPage = document.getElementById('records_per_page').value;
	location.href = document.getElementById('base___URL').value+'admin/general/chnageRecordsPerPage/agents/'+recordsPerPage;
}


function InfoAll(infoType){
	
	if(infoType == 1){
		document.getElementById('company__info').style.display = 'block';
	}
	else{
		document.getElementById('company__info').style.display = 'none';		
	}
	
}