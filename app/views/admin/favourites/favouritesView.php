<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?=$pageTitle?></title>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/favourites.js"></script>

<script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>

</head>



<body style="background:#f6f6f6;">

	<?=$this->load->view('admin/header');?>	

<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        	<div class="heading" style="float:left;"><?=$heading?></div>

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

            	<form id="FRM_ACTIVE_ALL" action="<?=base_url().'admin/favourites/performAction/'.$page?>" method="post">

            	

            	<div class="grid-head" style="background:#f4f1f1;">

            	<div class="grid-data2"><input type="checkbox" class="input1" name="CB_all" id="CB_all"  onclick="genralActions('<?=base_url()?>', '<?=$page?>');"/></div>

                <div class="grid-data2"><a>#</a></div>

                <div class="grid-data" style="width:559px; color:#000;"><a>Property Title</a></div>
                <div class="grid-data" style="width:120px; color:#000;"><a>Date</a></div>
                                            

                <div class="grid-data" style="color:#000;" align="center"><strong>Actions</strong></div>

            </div>

            

				<?php			

                

                foreach($QUERY->result() as $row){					

                    if($bgColor == '#f4f1f1'){ $bgColor = '#FFF';} else $bgColor = '#f4f1f1';
					$property_title = $this->general_model->single_value("property_id = '$row->property_id'", 'title', 'tbl_properties_list');
                ?>

                    <div class="grid-head" style="background:<?=$bgColor?>;">                    	

                        <div class="grid-data2"><input type="checkbox" id="CB<?=++$chkCount?>" name="CB<?=$chkCount?>" value="<?=$row->property_id?>" /></div>

                        <div class="grid-data2" style="color:#d20000;"><?=++$counter?></div>

                        <div class="grid-data" style="width:559px;"><a href="<?=base_url().'property/info/'.$row->property_id.'/'.$page?>" title="Edit / Update..." style="font-weight:normal; color:#999999;"><?=$property_title;?></a></div>
                        <div class="grid-data" style="width:120px;"><?=displayDate($row->Date)?></div>                       


                        <div class="grid-data">
                            <div style="text-align:center;" align="center"><a href="javascript: void(0);" title="Remove..." onclick="deleteEntry('<?=base_url().'admin/favourites/delete/'.$row->ID.'/'.$page?>')"><img src="<?=base_url()?>btPublic/admin/images/delete.png" style="margin-top:3px;" /></a></div>
                    </div>

				<?php

				}

				echo '<input type="hidden" name="counter_number" id="counter_number" value="'.$chkCount.'"/>';

				echo '<input type="hidden" name="actionType" id="actionType" />';												

				?>            

                        
				<div style="clear:both;"></div>
            	<div class="grid-bg">            	

                

                <div class="pagging">

                	<?=$this->pagination->create_links().paginationList();?>

                </div>

            </div>

            </form>

            <?php

			}

			else{				
				echo '<div class="info_MSG">No favourites available.</div>';
			}

			?>

        </div>

        <div class="clear"></div>

</div>

<div class="clear"></div>

<?=$this->load->view('admin/footerView')?>

</body>

</html>

