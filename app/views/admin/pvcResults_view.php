<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$pageTitle?></title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />
    <script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/payment.js"></script>
    <script type="text/javascript" src="<?=base_url()?>btPublic/admin/js/general.js"></script>
</head>



<body style="background:#f6f6f6;">
<?=$this->load->view('admin/header');?>
<div class="wrapper">

    <?=$this->load->view('admin/left_bar_linksView')?>

    <div class="rightbar">

        <div class="heading" style="float:left;"><?=$heading?></div>
        <!--
            <div style="float:right; padding-top:20px;">

            	<a href="<?=base_url().'admin/pvcpayment/add'?>" class="top_link"><img src="<?=base_url()?>btPublic/admin/images/icons-big/add-large.png" width="24" height="24" />Add Payment Plan</a>

            </div> -->
        <!--
            <div class="search_DIV">

            	<?php

        $data['controller__Name'] = 'payment';

        $this->load->view('admin/searchBox_view', $data);

        ?>

            </div> -->

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

            <form id="FRM_ACTIVE_ALL" action="<?=base_url().'admin/pvcpayment/performAction/'.$page?>" method="post">
                <!--
            	<div class="grid-bg">



                <ul>

                	<li><a href="<?=base_url().'admin/pvcpayment/add'?>">Add New</a></li>

                	<li><a href="javascript: performAction('activeAll')">Active</a></li>

                    <li><a href="javascript: performAction('inActiveAll')">In Active</a></li>

                    <li><a href="javascript: performAction('deleteAll')" style="background:none;">Delete</a></li>

                </ul>

                <div class="pagging">

                	<?=$this->pagination->create_links().paginationList();?>

                </div>

            </div> -->

                <div class="grid-head" style="background:#f4f1f1;">

                    <div class="grid-data2"><input type="checkbox" class="input1" name="CB_all" id="CB_all"  onclick="genralActions('<?=base_url()?>', '<?=$page?>');"/></div>

                    <div class="grid-data2"><a href="<?=base_url().'admin/pvcpayment/Sort/ID'?>">#</a></div>

                    <div class="grid-data" style="width:100px; color:#000;"><a href="<?=base_url().'admin/pvcpayment/Sort/title'?>">Service</a></div>
                    <div class="grid-data" style="width:100px; color:#000;"><a href="<?=base_url().'admin/pvcpayment/Sort/price'?>">Name</a></div>
                    <div class="grid-data" style="width:70px; color:#000;"><a href="<?=base_url().'admin/pvcpayment/Sort/price'?>">Contact</a></div>
                    <div class="grid-data" style="width:70px; color:#000;"><a href="<?=base_url().'admin/pvcpayment/Sort/price'?>">Password</a></div>
                    <div class="grid-data" style="width:308px; color:#000;"><a href="<?=base_url().'admin/pvcpayment/Sort/price'?>">Address</a></div>
                    <!--                <div class="grid-data" style="width:120px; color:#000;"><a href="--><?//=base_url().'admin/pvcpayment/Sort/date'?><!--">Date</a></div>-->
                    <!---->
                    <!--                <div class="grid-data" style="width:90px; color:#000;"><strong>Status</strong></div>-->

                    <div class="grid-data" style="color:#000;"><strong>File</strong></div>

                </div>



                <?php



                foreach($QUERY->result() as $row){

                    if($bgColor == '#f4f1f1'){ $bgColor = '#FFF';} else $bgColor = '#f4f1f1';

                    ?>

                    <div class="grid-head" style="background:<?=$bgColor?>;">

                        <div class="grid-data2"><input type="checkbox" id="CB<?=++$chkCount?>" name="CB<?=$chkCount?>" value="<?=$row->ID?>" /></div>

                        <div class="grid-data2" style="color:#d20000;"><?=++$counter?></div>

                        <div class="grid-data" style="width:100px;"><?=$row->service?></div>
                        <div class="grid-data" style="width:100px;"><?=$row->name?> </div>
                        <div class="grid-data" style="width:70px;"><?=$row->contact?> </div>
                        <div class="grid-data" style="width:70px;"><?=$row->password?> </div>
                        <div class="grid-data" style="width:308px;"><?=$row->address ?> </div>



                        <div class="grid-data">

                            <div style="float:left; padding-left: 10px;"><a href="<?=base_url().'btPublic/bt-uploads/'.$row->filepath?>" title="Download" download><img src="<?=base_url()?>btPublic/admin/images/download.png" style="padding-top:3px;height: 16px;"/></a></div>
                            <!--
                            <div style="float:left;"> | </div>

                            <div style="float:left; padding-left:7px;"><a href="javascript: void(0);" title="Remove..." onclick="deleteEntry('<?=base_url().'admin/pvcpayment/delete/'.$row->ID.'/'.$page?>')"><img src="<?=base_url()?>btPublic/admin/images/delete.png" style="margin-top:3px;" /></a></div> -->

                        </div>

                    </div>

                    <?php

                }

                echo '<input type="hidden" name="counter_number" id="counter_number" value="'.$chkCount.'"/>';

                echo '<input type="hidden" name="actionType" id="actionType" />';

                ?>



                <!--            	<div class="grid-bg">

                <ul>

                	<li><a href="<?=base_url().'admin/pvcpayment/add'?>">Add New</a></li>

                	<li><a href="javascript: performAction('activeAll')">Active</a></li>

                    <li><a href="javascript: performAction('inActiveAll')">In Active</a></li>

                    <li><a href="javascript: performAction('deleteAll')" style="background:none;">Delete</a></li>

                </ul>

                <div class="pagging">

                	<?=$this->pagination->create_links().paginationList();?>

                </div>

            </div> -->

            </form>

            <?php

        }

        else{
            if($page > 0){

                redirect(base_url().'admin/pvcpayment/p/'.($page-$per_page), 'refresh');

            }

            if((bool)($this->session->userdata($sessionSearch)) == TRUE){

                $this->load->view('admin/searchResults_view', $data);

            }

            else{

                echo '<div class="info_MSG">No Payment Plan available for this section.<br/>Click <a href="'.base_url().'admin/pvcpayment/add">HERE</a> to add payment...</div>';

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

