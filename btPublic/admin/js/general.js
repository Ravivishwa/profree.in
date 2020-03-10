// JavaScript Document

function clearFieldValue(fieldId, fieldValue){
	
	if(document.getElementById(fieldId).value == fieldValue){
		
		document.getElementById(fieldId).style.color = '#999';
		document.getElementById(fieldId).value = '';	
	}
}


function addFieldValue(fieldId, fieldValue){
			
	if(document.getElementById(fieldId).value == ''){
		
		document.getElementById(fieldId).style.color = '#d20000';
		document.getElementById(fieldId).value = fieldValue;
	}
	
}


function showCities(countryId){
	var baseUrl = document.getElementById('base___url').value;	
	$data = '';
	
	document.getElementById('cities_view').innerHTML = '<img src="'+baseUrl+'btPublic/admin/images/ajax-waiting.gif" />&nbsp; Loading cities...';
	
	if(countryId == '' || countryId == ' '){
		countryId = 0;
	}
	
	$.ajax({
		url: baseUrl+"admin/general/showCitiesList/"+countryId,  
		type: "GET",        
		data: $data,     
		//cache: false,
		success: function (html) {  
			$('#cities_view').html(html);     
		}       
	});
}


function validateSearchForm(){
	
	if(document.getElementById('SEARCH_DTA').value.trim() == ''){
		document.getElementById('SEARCH_DTA').value = '';
		document.getElementById('SEARCH_DTA').style.backgroundColor = '#FBC2C4';
		document.getElementById('SEARCH_DTA').focus();
		return false;	
	}
}

function validateSearchReportForm(){
	
	if(document.getElementById('SEARCH_DTA').value.trim() == '' && document.getElementById('DATE1').value.trim() == '' && document.getElementById('DATE2').value.trim() == ''){
		document.getElementById('SEARCH_DTA').value = '';
		document.getElementById('SEARCH_DTA').style.backgroundColor = '#FBC2C4';
		document.getElementById('SEARCH_DTA').focus();
		return false;	
	}
}

function clearSearchField(){
	document.getElementById('SEARCH_DTA').style.backgroundColor = '#FFF';
}

function clearSearchReportField(fieldID){
	document.getElementById(fieldID).style.backgroundColor = '#FFF';
}

function dateSearchLoadFiles(){
	$data = '';
	var baseUrl = document.getElementById('base___url').value;
	
	var searchType = 0;	
	if(document.getElementById('searchByDate').checked == false){
		window.location.reload();
	}	
	
	$.ajax({
		url: baseUrl+"admin/general/LoadCalendarFiles_Search",  
		type: "GET",        
		data: $data,     
		//cache: false,
		success: function (html) {  
			$('#Date__Seach_Info').html(html);     
		}       
	});	
}