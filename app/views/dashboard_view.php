<!DOCTYPE html>

<html lang="en">
<?=$this->load->view('include/head_section')?>
<style type="text/css">
.dashboard {
	float: left;
	margin-right: 20px;
	margin-bottom: 20px;
}
.bashbaord_link {
	-moz-user-select: none;
	background: #2C3476;
	border: 1px solid #2C3476;
	border-radius: 4px;
	cursor: pointer;
	display: inline-block;
	font-size: 18px;
	font-weight: 400;
	line-height: 1.42857;
	margin-bottom: 0;
	padding: 42px;
	text-align: center;
	vertical-align: middle;
	white-space: nowrap;
	color: #fff;
	width: 200px;
}
.bashbaord_link:hover {
	background: #7da400;
	border: 1px solid #7da400;
	color: #fff;
	text-decoration: none;
}
</style>

<body>
<div class="siteWraper">
  <?=$this->load->view('include/top_bar')?>
  <?=$this->load->view('include/top_header')?>
  
  <!--detail Block-->
  
  <div class="detailpagewrap">
    <div class="container">
      <div class="row">
        <div class="col-md-10"> 
          
          <!--Account info-->
            <h3 class="sectitle">Dashboard,
              <span><?=$this->session->userdata('userName')?></span>
            </h3>
            <?=$Message?>
            <div class="formint">
              <div class="row">
            
              <div class="col-md-3"><div class="dashboardLink">
              <i class="fa fa-plus-square" aria-hidden="true"></i>
              <a href="<?=base_url().'property/add'?>">Add Property</a>
              </div></div>
              
              <div class="col-md-3"><div class="dashboardLink">
              <i class="fa fa-list" aria-hidden="true"></i>
              <a href="<?=base_url().'property/user_listing'?>">My Properties</a>
              </div></div>
              
              <div class="col-md-3"><div class="dashboardLink">
              <i class="fa fa-paypal" aria-hidden="true"></i>
              <a href="<?=base_url().'payment'?>">Payment Plans</a>
              </div></div>
              
              <div class="col-md-3"><div class="dashboardLink">
              <i class="fa fa-user" aria-hidden="true"></i>
              <a href="<?=base_url().'user_profile'?>">Manage Profile</a>
              </div></div>
              
              </div>
              
            </div>
        </div>
        
        <!--/Job Detail-->
        
        <?=$this->load->view('include/right_side_ads_bar')?>
      </div>
    </div>
  </div>
  
  <!--/detail Block-->
  
  <div class="buildings"></div>
  
  <!--Footer-->
  
  <?=$this->load->view('include/footer')?>
</div>
<?=$this->load->view('include/bottom_files')?>
</body>
</html>