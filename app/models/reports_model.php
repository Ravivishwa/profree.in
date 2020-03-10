<?php

/**
 * Model for User registration & management
 *
 * @author Asim Iqbal
 */
class Reports_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
		
	public function getTotalDataSimple($requiredFieldName, $table){
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);
		
        $resultSet = $this->db->get();
        
		return $resultSet->num_rows;
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
	
	public function getTotalDataSingleArgumentSearchVoucher($compareFieldName, $Date1, $Date2, $dbFieldsArray, $requiredFieldName, $table, $agentType, $agentId, $DATE_SEARCH = NULL){
		
		$date_srch = 'date';
		if($DATE_SEARCH != NULL){
			$date_srch = $DATE_SEARCH;
		}
		
		$this->db->select($requiredFieldName);
        $this->db->from($table);				
		
		$searchArguments = '';
		$isKeyword = false;
		$TOTAL = sizeof($dbFieldsArray);
		
		
		if($compareFieldName != ''){
			$isKeyword = true;
			$searchArguments = '(';
			for($i=0; $i<$TOTAL; $i++){
				if($TOTAL != ($i+1)){
					$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%' OR ";
				}
				else
				$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%')";
			}
		}
		
		if($Date1 != '' && $Date2 != ''){
			if($isKeyword){
				$searchArguments.= " and (".$date_srch." BETWEEN '$Date1' AND '$Date2')";
			}
			else
				$searchArguments.= "".$date_srch." BETWEEN '$Date1' AND '$Date2'";
		}
		else{
			if($Date1 != '' || $Date2 != ''){
				
				if($isKeyword){
					$searchArguments.= " and (".$date_srch." = '$Date1' or ".$date_srch." = '$Date2')";
				}
				else
					$searchArguments.= "".$date_srch." = '$Date1' or ".$date_srch." = '$Date2'";
			}
		}
			
		
		$this->db->where($searchArguments);
		
        $resultSet = $this->db->get();
        
		return  $resultSet->num_rows;	
	}
	
	public function getAllDataSingleArgumentSEARCH_Voucher($compareFieldName, $Date1, $Date2, $dbFieldsArray, $table, $limit, $start, $orderBy, $orderType, $agentType, $agentId, $DATE_SEARCH = NULL) {
		
		$date_srch = 'date';
		if($DATE_SEARCH != NULL){
			$date_srch = $DATE_SEARCH;
		}
		
       	$this->db->select('*');
        $this->db->from($table);
		
		$searchArguments = '';
		$isKeyword = false;
		$TOTAL = sizeof($dbFieldsArray);
		
		if($compareFieldName != ''){
			$isKeyword = true;
			$searchArguments = '(';
			for($i=0; $i<$TOTAL; $i++){
				if($TOTAL != ($i+1)){
					$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%' OR ";
				}
				else
				$searchArguments.= $dbFieldsArray[$i]." like '%$compareFieldName%')";
			}
		}
		
		if($Date1 != '' && $Date2 != ''){
			if($isKeyword){
				$searchArguments.= " and (".$date_srch." BETWEEN '$Date1' AND '$Date2')";
			}
			else
				$searchArguments.= "".$date_srch." BETWEEN '$Date1' AND '$Date2'";
		}
		else{
			if($Date1 != '' || $Date2 != ''){
				
				if($isKeyword){
					$searchArguments.= " and (".$date_srch." = '$Date1' or ".$date_srch." = '$Date2')";
				}
				else
					$searchArguments.= "".$date_srch." = '$Date1' or ".$date_srch." = '$Date2'";
			}
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
}

?>
