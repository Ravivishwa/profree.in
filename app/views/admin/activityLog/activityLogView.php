<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/activities.js"></script>
<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
</head>

<body style="background:#f6f6f6;">
	<?=$this->load->view('admin/header');?>	
<div class="wrapper">
    <?=$this->load->view('admin/left_bar_linksView')?>
    <div class="rightbar">
        	<div class="heading" style="float:left;"><?=$heading?></div>
            <div style="float:right; padding-top:20px;">
            	&nbsp;
            </div>
            <div class="search_DIV">
            	<?php
				$data['controller__Name'] = 'activityLog';								
				$this->load->view('admin/searchBox_view', $data);
				?>				
            </div>
            <div class="clear"></div>
            
            <?php
			$errorMessage = getMessage('error_message');
			$success_message = getMessage('success_message');
			$info_message = getMessage('info_message');
            if($errorMessage != ''){echo '<div class="error_message">'.$errorMessage.'</div>'; }
			if($success_message != ''){echo '<div class="success_message">'.$success_message.'</div>'; }
			if($info_message != ''){echo '<div class="info_message">'.$info_message.'</div>'; }
			
			if((bool)$QUERY > 0){
			?>            
            	<form id="FRM_ACTIVE_ALL" action="<?=base_url().'admin/activityLog/performAction/'.$page?>" method="post">
            	<div class="grid-bg">
            	
                <ul style="width:25%;">
                    <li><a href="javascript: performAction('deleteAll')" style="background:none;">Delete</a></li>
                </ul>                
                <div class="pagging">
                	<?=$this->pagination->create_links().paginationList();?>
                </div>
            </div>
            	<div class="grid-head" style="background:#f4f1f1;">
            	<div class="grid-data2"><input type="checkbox" class="input1" name="CB_all" id="CB_all"  onclick="genralActions('<?=base_url()?>', '<?=$page?>');"/></div>
                <div class="grid-data2"><a href="<?=base_url().'admin/activityLog/Sort/ID'?>">#</a></div>
                <div class="grid-data" style="width:150px; color:#000;">Agent Name</div>
                <div class="grid-data" style="width:300px; color:#000;"><strong>Details</strong></div>
                <div class="grid-data" style="color:#000; width:200px;"><a href="<?=base_url().'admin/activityLog/Sort/date'?>">Date</a></div>
                <div class="grid-data" style="color:#000;"><strong>Actions</strong></div>
            </div>
            
				<?php			
                
                foreach($QUERY->result() as $row){					
                    if($bgColor == '#f4f1f1'){ $bgColor = '#FFF';} else $bgColor = '#f4f1f1';
                ?>
                    <div class="grid-head" style="background:<?=$bgColor?>;">                    	
                        <div class="grid-data2"><input type="checkbox" id="CB<?=++$chkCount?>" name="CB<?=$chkCount?>" value="<?=$row->ID?>" /></div>
                        <div class="grid-data2" style="color:#d20000;"><?=++$counter?></div>
                        <div class="grid-data" style="width:150px;"><a href="#" title="Edit / Update..." style="font-weight:normal; color:#999999;"><?=$this->general_model->getSingleValue($row->agentId, 'ID', 'name', 'tbl_agents');?></a></div>
                        <div class="grid-data" style="width:300px;"><?=$row->activityDetails?></div>                        
                        <div class="grid-data" style="width:200px;"><?=displayDateShort($row->date).' <font color="#000000">'.$row->time.'</font>'?></div>                        
                        <div class="grid-data">                            
                            <div style="float:left; padding-left:7px;"><a href="javascript: void(0);" title="Remove..." onclick="deleteEntry('<?=base_url().'admin/activityLog/delete/'.$row->ID.'/'.$page?>')"><img src="<?=base_url()?>btPublic/admin/images/delete.png" style="margin-top:3px;" /></a></div>
                        </div>
                    </div>
				<?php
				}
				echo '<input type="hidden" name="counter_number" id="counter_number" value="'.$chkCount.'"/>';
				echo '<input type="hidden" name="actionType" id="actionType" />';												
				?>            
                        
            	<div class="grid-bg">            	
                <ul style="width: 25%;">
                    <li><a href="javascript: performAction('deleteAll')" style="background:none;">Delete</a></li>
                </ul>
                <div class="pagging">
                	<?=$this->pagination->create_links().paginationList();?>
                </div>
            </div>
            </form>
            <?php
			}
			else{
				if($page > 0){
					redirect(base_url().'admin/activity-log/p/'.($page-$per_page), 'refresh');
				}
				echo '<div class="info_MSG">No activity available for this section.</div>';
			}
			?>
        </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
<?=$this->load->view('admin/footerView')?>
</body>
</html>
