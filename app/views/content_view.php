<!DOCTYPE html>
<html lang="en">
<?=$this->load->view('include/head_section')?>
<body>
<div class="siteWraper"> 
  <!--Header-->
  <?=$this->load->view('include/top_bar')?>
  <?=$this->load->view('include/top_header')?>
  <!--/Header--> 
  
  <!--detail Block-->
  
    <div class="container">
      <div class="contentpages">
      		<div class="row">
            	<div class="col-md-10">
                	<h3><?=$heading?></h3>
                    <p>
                    <?=$details?>
                    </p>
                </div>
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