<?php

/**
 * Model for User registration & management
 *
 * @author Asim Iqbal
 */
class Csv_model extends CI_Model {
	
	var $path = '../btPublic/CSV/';
	var $Table = '';
	var $requiredFields = '';	
	var $startLimit = '';
	var $EndLimit = '';
	var $limit = '';
	var $orderBy = '';
	var $whereClouse = '';
	
    public function __construct() {
        parent::__construct();
    }
		
	function query ($query)
    {		
		$result = mysql_query($query) or die("<br>".mysql_error());
        return $result;
    }

	function SelectAll(){
						
		$query = "select ".$this->requiredFields." from $this->Table ".$this->whereClouse." $this->limit $this->startLimit $this->EndLimit $this->orderBy";
		$result = $this->query($query);
        return $result;
	}

    function createcsv($tablename, $requiredFieldsArray, $whereClouse, $startLimit, $endLimit, $orderBy, $exportFileName){
		
		$this->Table = $tablename;
		if($whereClouse != ''){ $this->whereClouse = ' where '.$whereClouse;}
		if($startLimit !='' && $endLimit != ''){ $this->limit = ' limit '; $this->startLimit = $startLimit.', '; $this->EndLimit = $endLimit;}
		if($orderBy != ''){$this->orderBy = ' order by '.$orderBy;}
		
		$total = sizeof($requiredFieldsArray);		
		for($i=0; $i<$total; $i++){
			
			if($i+1 < $total){
				$this->requiredFields.= $requiredFieldsArray[$i].', ';
			}
			else
				$this->requiredFields.= $requiredFieldsArray[$i];
		}
		
    	$rs  = $this->SelectAll();
        $rs1 = $this->SelectAll();
        if($rs){
            $string ="";
            /// Get the field names
            $fields =  mysql_fetch_assoc($rs1);
            if(!is_array($fields))
              return;
            while(list($key,$val) =each($fields))
                $string .= $key.',';
            $string = substr($string,0,-1)."\015\012";
            /// Get the data
            while($row = mysql_fetch_assoc($rs)) {
                while(list($key,$val) =each($row)){
                  $row[$key] = htmlentities($row[$key], ENT_COMPAT, "UTF-8");
                  $row[$key] = str_replace(',',' ',rtrim($row[$key]));
                  $row[$key] = str_replace("\015\012",' ',$row[$key]);
                }
                $string .= (implode($row,","))."\015\012";
             }
			$this->path =  realpath(APPPATH.$this->path); 
			
			$fp = fopen($this->path.'/'.$exportFileName.".csv",'w');
            fwrite($fp,$string);
            fclose($fp);
        }

    }    		
}

?>
