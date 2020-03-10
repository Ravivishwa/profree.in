<?php

/**
 * Model for User registration & management
 *
 * @author Asim Iqbal
 */
class General_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function duplicateEntry($dbFieldName, $compareFieldName, $table) {

        $this->db->select($dbFieldName);
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);        		


        $dataValues = $this->db->get();
		
        if ($dataValues->num_rows > 0) {
           return true;
        }
		
		return false;
    }		
	
	
	public function isModuleActive($moduleId){
		
		$this->db->select($moduleId);
        $this->db->from('tbl_settings');
		$this->db->where($moduleId, 'YES');
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = TRUE;
        } else {
            $returnValue = FALSE;
        }

        $resultSet->free_result();
        return $returnValue;
	}
	
	
	public function getAllDataSimple($table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		if($limit != ''){ $this->db->limit($limit, $start); }
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function getAllDataSimple1($table, $limit, $start, $orderBy, $orderType) {
		$CI = & get_instance();
       	$this->db->select('*');
        $this->db->from($table);
		if($limit != ''){ $this->db->limit($limit, $start); }
		if($CI->session->userdata('agentType') != 0){
			$this->db->where('agentId', $CI->session->userdata('agentId'));
		}
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function getAllData($whereClouse, $table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		if($whereClouse != ''){
			$this->db->where($whereClouse);	
		}
		if($limit != ''){ $this->db->limit($limit, $start); }
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function getAllDataSingleArgument($compareFieldName, $dbFieldName, $table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);		
		if($limit !='' && $start != ''){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function getAllDataSingleArgumentSEARCH($compareFieldName, $dbFieldsArray, $table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		
		$searchArguments = '';
		$TOTAL = sizeof($dbFieldsArray);
		for($i=0; $i<$TOTAL; $i++){
			if($TOTAL != ($i+1)){
				$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%' OR ";
			}
			else
			$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%'";
		}
		$this->db->where($searchArguments);
		
		$this->db->limit($limit, $start);
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	public function getAllDataSingleArgumentSEARCH1($compareFieldName, $dbFieldsArray, $table, $limit, $start, $orderBy, $orderType) {
		$CI = & get_instance();

       	$this->db->select('*');
        $this->db->from($table);
		
		$searchArguments = '';
		$TOTAL = sizeof($dbFieldsArray);
		for($i=0; $i<$TOTAL; $i++){
			if($TOTAL != ($i+1)){
				$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%' OR ";
			}
			else
			$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%'";
		}
		$this->db->where($searchArguments);
		if($CI->session->userdata('agentType') != 0){
			$this->db->where('agentId', $CI->session->userdata('agentId'));
		}
		$this->db->limit($limit, $start);
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function getTotalDataSimple($requiredFieldName, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		
        $resultSet = $this->db->get();
        
		return $resultSet->num_rows;
	}
	
	public function getTotalDataSimple1($requiredFieldName, $table){
		$CI = & get_instance();
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		if($CI->session->userdata('agentType') != 0){
			$this->db->where('agentId', $CI->session->userdata('agentId'));
		}

        $resultSet = $this->db->get();
        
		return $resultSet->num_rows;
	}
	
	public function getTotalData($whereClouse, $requiredFieldName, $orderBy, $orderType, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		if($whereClouse != ''){
			$this->db->where($whereClouse);	
		}
		$this->db->order_by($orderBy, $orderType);
        $resultSet = $this->db->get();
        
		return $resultSet->num_rows;
	}
	
	public function getTotalDataSimpleSingleArgument($dbFieldName, $compareFieldName, $requiredFieldName, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		
        $resultSet = $this->db->get();
        
		return $resultSet->num_rows;
	}
	
	public function getTotalDataSingleArgument($compareFieldName, $dbFieldName, $requiredFieldName, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		
        $resultSet = $this->db->get();
        
		return  $resultSet->num_rows;
	}
	
	public function getTotalDataMultiArgument($whereClouse, $requiredFieldName, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		$this->db->where($whereClouse);
		
        $resultSet = $this->db->get();
        
		return  $resultSet->num_rows;
	}
	
	public function getTotalDataSingleArgumentSearch($compareFieldName, $dbFieldsArray, $requiredFieldName, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);				
		
		$searchArguments = '';
		$TOTAL = sizeof($dbFieldsArray);
		for($i=0; $i<$TOTAL; $i++){
			if($TOTAL != ($i+1)){
				$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%' OR ";
			}
			else
			$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%'";
		}
		$this->db->where($searchArguments);
		
        $resultSet = $this->db->get();
        
		return  $resultSet->num_rows;	
	}
	
	public function getTotalDataSingleArgumentSearch1($compareFieldName, $dbFieldsArray, $requiredFieldName, $table){
		$CI = & get_instance();
		$this->db->select($requiredFieldName);
        $this->db->from($table);				
		
		$searchArguments = '';
		$TOTAL = sizeof($dbFieldsArray);
		for($i=0; $i<$TOTAL; $i++){
			if($TOTAL != ($i+1)){
				$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%' OR ";
			}
			else
			$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%'";
		}
		$this->db->where($searchArguments);
		if($CI->session->userdata('agentType') != 0){
			$this->db->where('agentId', $CI->session->userdata('agentId'));
		}
        $resultSet = $this->db->get();
        
		return  $resultSet->num_rows;	
	}
	
    public function getSingleValue($compareFieldName, $dbFieldName, $requiredFieldName, $table) {
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();
			$returnValue = $returnValue->$requiredFieldName;
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	  public function single_value($whereClause, $requiredFieldName, $table) {
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		if($whereClause && $whereClause!='')
			$this->db->where($whereClause);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();
			$returnValue = $returnValue->$requiredFieldName;
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	public function getSingleValueGen($whereClause, $requiredFieldName, $table) {
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		$this->db->where($whereClause);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();
			$returnValue = $returnValue->$requiredFieldName;
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	public function getSingleValueMultiArguments($whereClouse, $requiredFieldName, $table) {
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		$this->db->where($whereClouse);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();
			$returnValue = $returnValue->$requiredFieldName;
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	
	public function getSingleData_Simple_No_comparison($table) {

       	$this->db->select('*');
        $this->db->from($table);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();			
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	
	public function getSingleData_Simple($compareFieldName, $dbFieldName, $table) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();			
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	public function getSingleData_TwoArguments($compareFieldName, $dbFieldName, $compareFieldName1, $dbFieldName1, $table) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		$this->db->where($dbFieldName1, $compareFieldName1);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();			
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	public function getSingleData_ThreeArguments($compareFieldName, $dbFieldName, $compareFieldName1, $dbFieldName1, $compareFieldName2, $dbFieldName2, $table) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		$this->db->where($dbFieldName1, $compareFieldName1);
		$this->db->where($dbFieldName2, $compareFieldName2);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();			
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	public function getSingleData_FourArguments($compareFieldName, $dbFieldName, $compareFieldName1, $dbFieldName1, $compareFieldName2, $dbFieldName2, $compareFieldName3, $dbFieldName3, $table) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($dbFieldName, $compareFieldName);
		$this->db->where($dbFieldName1, $compareFieldName1);
		$this->db->where($dbFieldName2, $compareFieldName2);
		$this->db->where($dbFieldName3, $compareFieldName3);
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();			
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
    }
	
	public function updateInfo_Simple($compareFieldName, $dbFieldName, $updateDbFieldsAry, $updateInfoAry, $table){
		
		$data = array();		
		for($i=0; $i<sizeof($updateDbFieldsAry); $i++){			
			$data[$updateDbFieldsAry[$i]] = $updateInfoAry[$i];	
		}
				
		
		$this->db->where($dbFieldName, $compareFieldName);
		
		if($this->db->update($table, $data)){
			return true;
		}
		
		return false;
	}
	
	public function updateInfo_Simple_TwoArguments($compareFieldName, $dbFieldName, $compareFieldName1, $dbFieldName1, $updateDbFieldsAry, $updateInfoAry, $table){
		
		$data = array();		
		for($i=0; $i<sizeof($updateDbFieldsAry); $i++){			
			$data[$updateDbFieldsAry[$i]] = $updateInfoAry[$i];	
		}
				
		
		$this->db->where($dbFieldName, $compareFieldName);
		$this->db->where($dbFieldName1, $compareFieldName1);
		
		if($this->db->update($table, $data)){
			return true;
		}
		
		return false;
	}
	
	
	public function updateInfo_Simple_ThreeArguments($compareFieldName, $dbFieldName, $compareFieldName1, $dbFieldName1, $compareFieldName2, $dbFieldName2, $updateDbFieldsAry, $updateInfoAry, $table){
		
		$data = array();		
		for($i=0; $i<sizeof($updateDbFieldsAry); $i++){			
			$data[$updateDbFieldsAry[$i]] = $updateInfoAry[$i];	
		}
				
		
		$this->db->where($dbFieldName, $compareFieldName);
		$this->db->where($dbFieldName1, $compareFieldName1);
		$this->db->where($dbFieldName2, $compareFieldName2);
		
		if($this->db->update($table, $data)){
			return true;
		}
		
		return false;
	}
	
	public function addInfo_Simple($insertDbFieldsAry, $insertInfoAry, $table){
		$data = array();
		
		for($i=0; $i<sizeof($insertDbFieldsAry); $i++){
			$data[$insertDbFieldsAry[$i]] = $insertInfoAry[$i];	
		}
				
		if($this->db->insert($table, $data)){
			return true;	
		}
		return false;
	}
	
	
	function listCountries($selectedCountry){
		
		$countruesList = 'No country available in databse!';
		
		$countries = $this->showCountries();
		
		if($countries != 0){
			$countruesList = '<select name="country" id="country" class="dropDown" style="pad" onchange="showCities(this.value);">';
			
			$countruesList.= '<option value=" " selected>Select country...</option>';
			foreach($countries as $country){
				if($country->ID != $selectedCountry){
					$countruesList.= '<option value="'.$country->ID.'">'.$country->name.'</option>';
				}
				else{
					$countruesList.= '<option value="'.$country->ID.'" selected>'.$country->name.'</option>';
				}
			}
			
			$countruesList.= '</select><input type="hidden" id="base___url" value="'.base_url().'" />';
				
		}
		return $countruesList;
	}			
	
	
		
	function listCities($countryId, $cityId){
			
		$citiesList = '<font color="#999999">No country selected.</font>';
		
		if($countryId > 0){	
			$citiesList = 'No city available for this country.';	
			
			$cities = $this->showCities($countryId);
			
			if($cities != 0){			
				$citiesList = '<select name="city" id="city"  class="dropDown">';
				$citiesList.= '<option value=" ">Select your city.</option>';
				foreach($cities as $city){
					if($cityId != $city->ID){
						$citiesList.= '<option value="'.$city->ID.'">'.$city->name.'</option>';
					}
					else
						$citiesList.= '<option value="'.$city->ID.'" selected>'.$city->name.'</option>';
				}
				$citiesList.= '</select>';
			}
		}
		return $citiesList;
	}
	
	function showDropDown($table, $name, $selectedName, $cssClassName){
			
		$ddList = '<select name="'.$name.'" id="'.$name.'" class="'.$cssClassName.'">';
		$ddList.= '<option value="">...</option>';		
						
		$DATA_INFO = $this->showDD_data($table, 'name');			
		if($DATA_INFO != 0){				
			
			foreach($DATA_INFO as $RESULT){
				if($selectedName != $RESULT->name){
					$ddList.= '<option value="'.$RESULT->name.'">'.$RESULT->name.'</option>';
				}
				else
					$ddList.= '<option value="'.$RESULT->name.'" selected>'.$RESULT->name.'</option>';
			}				
		}
				
		$ddList.= '</select>';
		
		return $ddList;
	}
	
	function showDropDownId($table, $name, $selectedName, $cssClassName){
			
		$ddList = '<select name="'.$name.'" id="'.$name.'" class="'.$cssClassName.'">';
		$ddList.= '<option value="">...</option>';		
						
		$DATA_INFO = $this->showDD_data($table, '*');			
		if($DATA_INFO != 0){				
			
			foreach($DATA_INFO as $RESULT){
				if($selectedName != $RESULT->ID){
					$ddList.= '<option value="'.$RESULT->ID.'">'.$RESULT->name.'</option>';
				}
				else
					$ddList.= '<option value="'.$RESULT->ID.'" selected>'.$RESULT->name.'</option>';
			}				
		}
				
		$ddList.= '</select>';
		
		return $ddList;
	}
	
	function showDropDownIdEvent($table, $name, $selectedName, $cssClassName, $eventDetails){
			
		$ddList = '<select name="'.$name.'" id="'.$name.'" class="'.$cssClassName.'" onchange="'.$eventDetails.'">';
		$ddList.= '<option value="">...</option>';		
						
		$DATA_INFO = $this->showDD_data($table, '*');			
		if($DATA_INFO != 0){				
			
			foreach($DATA_INFO as $RESULT){
				if($selectedName != $RESULT->ID){
					$ddList.= '<option value="'.$RESULT->ID.'">'.$RESULT->name.'</option>';
				}
				else
					$ddList.= '<option value="'.$RESULT->ID.'" selected>'.$RESULT->name.'</option>';
			}				
		}
				
		$ddList.= '</select>';
		
		return $ddList;
	}
	
	function showDropDownIdCustomEvent($table, $name, $selectedName, $cssClassName, $whereDb, $whereClause, $eventDetails){
			
		$ddList = '<select name="'.$name.'" id="'.$name.'" class="'.$cssClassName.'" onchange="'.$eventDetails.'">';
		$ddList.= '<option value="">...</option>';		
						
		$DATA_INFO = $this->showDD_dataCustom($table, '*', $whereDb, $whereClause);			
		if($DATA_INFO != 0){				
			
			foreach($DATA_INFO as $RESULT){
				if($selectedName != $RESULT->ID){
					$ddList.= '<option value="'.$RESULT->ID.'">'.$RESULT->name.'</option>';
				}
				else
					$ddList.= '<option value="'.$RESULT->ID.'" selected>'.$RESULT->name.'</option>';
			}				
		}
				
		$ddList.= '</select>';
		
		return $ddList;
	}	
			
	
	private function showCountries(){
		
        $this->db->select('ID, name');
        $this->db->from('tbl_countries');
		$this->db->where('status', 'YES');
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->result();
        } else {
            $returnValue = 0;
        }

        $resultSet->free_result();
        return $returnValue;
	}
	
	private function showDD_dataCustom($table, $requiredID, $dbWhere, $whereClause){
		$this->db->select($requiredID);
		$this->db->from($table);
		$this->db->where($dbWhere, $whereClause);
		$this->db->where('status', 'YES');
		$this->db->order_by('name', 'ASC');
		
		$result = $this->db->get();
		
		if($result->num_rows>0){
			
			$returnValue = $result->result();
		}
		else{
			$returnValue = 0;
		}
		
		$result->free_result();
		
		return $returnValue;
	}
	
	
	private function showDD_data($table, $requiredID){
		$this->db->select($requiredID);
		$this->db->from($table);
		$this->db->where('status', 'YES');
		$this->db->order_by('name', 'ASC');
		
		$result = $this->db->get();
		
		if($result->num_rows>0){
			
			$returnValue = $result->result();
		}
		else{
			$returnValue = 0;
		}
		
		$result->free_result();
		
		return $returnValue;
	}
	
	private function showCities($countryId){
		$this->db->select('*');
		$this->db->from('tbl_cities');
		$this->db->where('countryId	', $countryId);
		$this->db->where('status', 'YES');
		$this->db->order_by('name', 'ASC');
		
		$result = $this->db->get();
		
		if($result->num_rows>0){
			
			$returnValue = $result->result();
		}
		else{
			$returnValue = 0;
		}
		
		$result->free_result();
		
		return $returnValue;
	}
	
	function addAgentActivity($agentId, $activityTable, $activityId, $activityDetails, $date, $time){
		
		$data = array('agentId'=> $agentId, 'activityTable' => $activityTable, 'activityId' => $activityId, 'activityDetails' => $activityDetails, 'date' => $date, 'time' => $time);
		
		$this->db->insert('tbl_agents_activitylog', $data);
		
	}
	
	
	
	public function deleteData($compareFieldName, $dbFieldName, $table) {
       	       
		$this->db->where($dbFieldName, $compareFieldName);
		
		if($this->db->delete($table)){
			return true;
		}
		
		return false;		        
    }
	
	
	public function isModuleEnabled($module_name){
		
		if(isSuperAdmin()){
			return true;	
		}
		
		$this->db->select('ID');
        $this->db->from('tbl_settings');
		$this->db->where($module_name, 'YES');
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
           return true;
        }
		
		return false;
	}
	
	
	public function displayCourses(){
				
		$this->db->select('*');
        $this->db->from('tbl_courses');
		$this->db->where('status', 'YES');
		$this->db->order_by('name', 'ASC');
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
	}
	
	
	public function getAllDataMultipleArguments($whereClouse, $table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($whereClouse);	
		
		
		if($limit !='' && $start != ''){
			$this->db->limit($limit, $start);
		}
		
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	
	public function fetchSearchData($required_field){
		$this->db->select('*');
		$this->db->group_by($required_field);
        $this->db->from('tbl_products');
		$this->db->where("status = 'YES'");					
		$this->db->order_by($required_field, 'asc');		
        $resultSet = $this->db->get();		
        if ($resultSet->num_rows > 0) {			
            return $resultSet;	
        }
		else {            
			return 0;
        }
	}
	
	public function fetchDataAll($whereClouse, $table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($whereClouse);	
		
		
		if($limit > 0){
			$this->db->limit($limit, $start);
		}
		
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			
            return $resultSet;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function agent_info($agent_id) {

       	$this->db->select('*');
        $this->db->from('tbl_agents');
		$this->db->where("ID = '$agent_id'");	
		
        $resultSet = $this->db->get();		
        if ($resultSet->num_rows > 0) {
			$returnValue = $resultSet->row();
            return $returnValue;	
        } 
		else {            
			return 0;
        }				
    }
	
	public function fetchDataSingle($whereClouse, $table, $limit, $start, $orderBy, $orderType) {

       	$this->db->select('*');
        $this->db->from($table);
		$this->db->where($whereClouse);	
		
		
		if($limit > 0){
			$this->db->limit($limit, $start);
		}
		
		$this->db->order_by($orderBy, $orderType);
		
        $resultSet = $this->db->get();
		
        if ($resultSet->num_rows > 0) {
			$returnValue = $resultSet->row();
            return $returnValue;	
        } 
		else {
            
			return 0;
        }
				
    }
	
	public function properties_in_city($city_id){		
		$this->db->select('property_id');
        $this->db->from('tbl_properties_list');		
		$this->db->where('city', $city_id);			
        $resultSet = $this->db->get();     
		return $resultSet->num_rows;
	}	
	
	public function total_rows($whereClouse, $requiredFieldName, $table){		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		if($whereClouse != ''){
			$this->db->where($whereClouse);	
		}
        $resultSet = $this->db->get();        
		return $resultSet->num_rows;
	}			
}

?>
