// JavaScript Document

function validateInfo(){
	
	if(document.getElementById('name').value == 'Enter Gallery Title / Category.'){
		
		document.getElementById('name').value = '';
			
	}
	
}

function validateInfoPhoto(){
	
	
	if(document.getElementById('userfile').value != ''){
		document.getElementById('loading__DIV').style.display = 'block';
	}
	
	if(document.getElementById('userfile').value == ''){
		
		document.getElementById('userfile').style.backgroundColor = '#FBC2C4';
		return false;	
	}
	
}


function validateUpdatedPhoto(){
		
	if(document.getElementById('userfile').value == ''){
		document.getElementById('imageStatus').value = 'EMPTY';
	}
	else{
		document.getElementById('loading__DIV').style.display = 'block';
	}
}

function claerMessage(){
	
	document.getElementById('nameError').innerHTML = '';
}

function claerMessageImg(){
	
	document.getElementById('newImage').style.backgroundColor = '#FFF';
}



function deleteEntry(remove_URL){
	
	if(confirm("Are you really want to delete this. All pictures under this gallery will be removed!")){
		
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
	location.href = document.getElementById('base___URL').value+'admin/general/chnageRecordsPerPage/gallery/'+recordsPerPage;
}