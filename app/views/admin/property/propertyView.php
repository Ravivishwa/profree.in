<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/projects.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/property/add'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/add-large.png" width="24" height="24" />Add New Property</a>

            </div>

            <!--<div class="search_DIV">

            	<?php

				$data['controller__Name'] = 'property';								

				$this->load->view('admin/searchBox_view', $data);

				?>				

            </div>-->

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

            	<form id="FRM_ACTIVE_ALL" action="<?=base_url().'admin/property/performAction/'.$page?>" method="post">

            	<div class="grid-bg" style="width:100.5% !important; height:40px;">

            	

                <ul>

                	<li><a href="<?=base_url().'admin/property/add'?>">Add New</a></li>

                	<li><a href="javascript: performAction('activeAll')">Active</a></li>

                    <li><a href="javascript: performAction('inActiveAll')">In Active</a></li>

                    <li><a href="javascript: performAction('deleteAll')" style="background:none;">Delete</a></li>
<div style="clear:both;"></div>
                </ul>                

                <div class="pagging">
                	<?=$this->pagination->create_links().paginationList();?>
                    <div style="clear:both;"></div>
                </div>
<div style="clear:both;"></div>
            </div>
			<div style="clear:both;"></div>
            <div class="grid-head" style="background:#f4f1f1; width:101%;">

            	<div class="grid-data2" style="width:2%;">
                	<input type="checkbox" class="input1" name="CB_all" id="CB_all"  onclick="genralActions('<?=base_url()?>', '<?=$page?>');"/></div>

                <div class="grid-data2" style="width:3%;"><a href="<?=base_url().'admin/property/Sort/property_id'?>">#</a></div>

                <div class="grid-data" style="width:50%; color:#000;"><a href="<?=base_url().'admin/property/Sort/name'?>">Property Title</a></div>
                <div class="grid-data" style="width:20%; color:#000;"><a href="<?=base_url().'admin/property/Sort/date'?>">Date</a></div>
                               
                <div class="grid-data" style="width:10%; color:#000;"><strong>Status</strong></div>               

                <div class="grid-data" style="color:#000; width:9%;"><strong>Actions</strong></div>

            </div>

            <div style="clear:both;"></div>

				<?php			

                

                foreach($QUERY->result() as $row){					

                    if($bgColor == '#f4f1f1'){ $bgColor = '#FFF';} else $bgColor = '#f4f1f1';

                ?>

                    <div class="grid-head" style="background:<?=$bgColor?>; width:101%;">                    	

                        <div class="grid-data2"  style="width:2%;"><input type="checkbox" id="CB<?=++$chkCount?>" name="CB<?=$chkCount?>" value="<?=$row->property_id?>" /></div>

                        <div class="grid-data2" style="color:#d20000; width:3%;"><?=++$counter?></div>

                        <div class="grid-data" style="width:50%;"><a href="<?=base_url().'admin/property/update/'.$row->property_id.'/'.$page?>" title="Edit / Update..." style="font-weight:normal; color:#999999;"><?=$row->title;?></a></div>
                        <div class="grid-data" style="width:20%;"><?=displayDate($row->date)?></div>                       

                        <div class="grid-data" style="width:10%;"><a href="<?=base_url().'admin/property/changeStatus/'.$row->property_id.'/'.$row->status.'/'.$page?>" style="color:#999999; font-weight:normal;"><?=showStatus($row->status)?></a></div>

                        <div class="grid-data" style="width:9%;">

                            <div style="float:left; padding-right:7px;"><a href="<?=base_url().'admin/property/update/'.$row->property_id.'/'.$page?>" title="Edit / Update..."><img src="<?=base_url()?>btPublic/admin/images/edit.png" style="padding-top:3px;" /></a></div>

                            <div style="float:left;"> | </div>

                            <div style="float:left; padding-left:7px;"><a href="javascript: void(0);" title="Remove..." onclick="deleteEntry('<?=base_url().'admin/property/delete/'.$row->property_id.'/'.$page?>')"><img src="<?=base_url()?>btPublic/admin/images/delete.png" style="margin-top:3px;" /></a></div>

                        </div>
<div style="clear:both;"></div>
                    </div>
<div style="clear:both;"></div>
				<?php

				}

				echo '<input type="hidden" name="counter_number" id="counter_number" value="'.$chkCount.'"/>';

				echo '<input type="hidden" name="actionType" id="actionType" />';												

				?>            

                        

            	<div class="grid-bg" style="width:100.5% !important; height:40px;">            	

                <ul>

                	<li><a href="<?=base_url().'admin/property/add'?>">Add New</a></li>                	

                	<li><a href="javascript: performAction('activeAll')">Active</a></li>

                    <li><a href="javascript: performAction('inActiveAll')">In Active</a></li>

                    <li><a href="javascript: performAction('deleteAll')" style="background:none;">Delete</a></li>

                </ul>

                <div class="pagging">

                	<?=$this->pagination->create_links().paginationList();?>
<div style="clear:both;"></div>
                </div>
<div style="clear:both;"></div>
            </div>

            </form>

            <?php

			}

			else{				
				if($page > 0){

					redirect(base_url().'admin/property/p/'.($page-$per_page), 'refresh');

				}

				if((bool)($this->session->userdata($sessionSearch)) == TRUE){										

					$this->load->view('admin/searchResults_view', $data);

				}

				else{

					echo '<div class="info_MSG">No property available for this section.<br/>Click <a href="'.base_url().'admin/property/add">HERE</a> to add new property...</div>';

				}

			}

			?>

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>

