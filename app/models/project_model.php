<?php

/**
 * Model for User registration & management
 *
 * @author Asim Iqbal
 */
class Project_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
		
	
    public function projectName() {
		
       	$this->db->select('projectNameAtBackend');
        $this->db->from('tbl_settings');
		
        $resultSet = $this->db->get();
        if ($resultSet->num_rows > 0) {
            $returnValue = $resultSet->row();
			$returnValue = $returnValue->projectNameAtBackend;
        } else {
            $returnValue = 'Untitled Project';
        }

        $resultSet->free_result();
        return $returnValue;
    }					
}

?>
