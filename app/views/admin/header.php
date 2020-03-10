<?php
if(!isSuperAdmin()){
?>
<style type="text/css">
.wrapper .rightbar{
	width:1125px !important;	
}
</style>
<?php	
}
?>
<style type="text/css">
.topbar {
    background: #555 none repeat scroll 0 0;
    padding: 7px 0;
}
.topheader {
    background: #fff url("../../images/nav-bg.jpg") repeat-x scroll center bottom;
    box-shadow: 0 2px 2px #ccc;
}
.topheader{
	margin:0 auto;	
}
.head_navk{
	float:right;
	margin:0 auto;	
}
.head_navk ul{
	line-height:26px;
	list-style:none;
}
.head_navk ul li{
	float:left;
}
.head_navk ul li a{
	display: block;
    font-size: 14px;
    font-weight: bold;
    position: relative;
	border-right: 1px solid #e5e5e5;
    color: #666;
    padding: 20px 20px;
	text-decoration:none;
}
.head_navk ul li a:hover{
	text-decoration:underline;
}
.admin_top_bar{
	height:20px;	
}
.admin_top_bar a{
	color:#fff;
	float:left;
	margin-right:10px;
	text-decoration:none !important;
}
.admin_top_bar a:hover{
	text-decoration:underline !important;
}
</style>
<div class="topbar">
	<div class="wrapper">
    <div class="admin_top_bar" style="float:left;"><a href="<?=base_url()?>admin/property/add">Post a New Property</a></div>
    <div class="admin_top_bar" style="float:right;">
        <?php
        if(isLogin()){
            echo '<a href="'.base_url().'dashboard">Dashboard</a>';
            if(isSuperAdmin()){
                echo '<a href="'.base_url().'admin/agents/update/1">Change Profile Settings</a>';
            }
            echo '<a href="'.base_url().'admin/property">My Properties</a>';
            echo '<a href="'.base_url().'logout">Logout</a>';
        }
        else{
            echo '<a href="'.base_url().'admin/login">Login</a>';
            echo '<a href="'.base_url().'register">Register</a>';
            echo '<a href="'.base_url().'admin/login">My Properties</a>';
        }
        ?>
    </div>
    <div style="clear:both;"></div>
    </div>
</div>

<div  class="wrapper">
		<div style="float:left; margin:0 auto;">          
          <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url().'btPublic/html/'?>images/logo.png" /></a>
        </div>
        
        <div class="head_navk">
            <ul>        	
                <li <?=selectLinkTop($this->uri->segment(2), 'Sale')?>><a href="<?=base_url().'property/Sale'?>">Sell</a> </li>                    
                <li <?=selectLinkTop($this->uri->segment(2), 'Rent')?>><a href="<?=base_url().'property/Rent'?>">Rent</a></li>
                <li <?=selectLinkTop($this->uri->segment(2), 'Wanted')?>><a href="<?=base_url().'property/Wanted'?>">Wanted</a></li>
                <li <?=selectLinkTop($this->uri->segment(2), 'Commercial')?>><a href="<?=base_url().'property/Commercial'?>">Commercial</a></li>
                <li <?=selectLinkTop($this->uri->segment(1), 'agents')?>><a href="<?=base_url().'agents'?>" style="border-right:none !important;">Agents</a></li>
            </ul>
        </div>
</div>
<?php /*$this->load->view('include/head_section');
$this->load->view('include/top_bar');
$this->load->view('include/top_header'); */?>