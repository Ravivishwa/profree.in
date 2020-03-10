// JavaScript Document

function validateInfo(){
		
		
}

function claerMessage(){
	
	/*document.getElementById('question').innerHTML = '';*/
}



function deleteEntry(remove_URL){
	
	if(confirm("Are you really want to delete this employee!")){
		
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
	location.href = document.getElementById('base___URL').value+'admin/general/chnageRecordsPerPage/employeeOfMonth/'+recordsPerPage;
}