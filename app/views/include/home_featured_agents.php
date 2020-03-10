<?php
$get_featured_agents = $this->general_model->fetchDataAll("type = '1' and picture != '' and featured = 'YES'", 'tbl_agents', 0, 0, 'name', 'asc');
if($get_featured_agents){
	echo '<div class="container">
		<!--Employers-->		
		<div class="titlebar">		
		<h3 class="sectitle">Featured Agents</h3>		
		</div>';
	echo '<ul class="agentList row">';
	foreach($get_featured_agents->result() as $res_featured){		
		echo '<li class="col-md-2 col-sm-3 col-xs-6"><a href="'.base_url().'agents/property/'.url_title($res_featured->name, 'dash', true).'-'.$res_featured->ID.'" title="'.$res_featured->name.'"><img src="'.base_url().'btPublic/bt-uploads/'.$res_featured->picture.'"  /></a></li>';
	}
	echo '</ul> ';
	echo '</div>';
}
?>