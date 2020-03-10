<div class="footerWrap">
    <div class="container">
        <div class="col-md-3">
            <h5>Useful Links</h5>
            <ul class="quicklinks">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li><a href="<?=base_url().'content/about-us'?>">About Us</a></li>
                <li><a href="<?=base_url().'contact'?>">Contact Us</a></li> 
                <li><a href="<?=base_url().'content/help-support'?>">Help &amp; Support</a></li>           
            </ul>
        </div>
        
        <div class="col-md-3">
            <h5>&nbsp;</h5>
            <ul class="quicklinks">
             <li><a href="<?=base_url().'agents'?>">Agents</a></li>
            <li><a href="<?=base_url().'property/Commercial'?>">Commercial</a></li>
            <li><a href="<?=base_url().'content/privacy-policy'?>">Privacy Policy</a></li>
            <li><a href="<?=base_url().'content/terms-of-use'?>">Terms of Use</a></li>
            </ul>
        </div>                
        
        <div class="col-md-3">
            <h5>&nbsp;</h5>
            <ul class="quicklinks">           
            <li><a href="<?=base_url().'admin/property/add'?>">Post New Property</a></li>
            <li><a href="<?=base_url().'property/Sale'?>">Sell</a></li>
            <li><a href="<?=base_url().'property/Rent'?>">Rent</a></li>
            <li><a href="<?=base_url().'property/Wanted'?>">Wanted</a></li>
            </ul>
        </div>
        
        <div class="col-md-3">
            <h5>Social Links</h5>
            	<?php $rowsocial=$this->general_model->getSingleData_Simple_No_comparison('tbl_sociallinks');?>
                <div class="sociallinks">
                <a href="<?php echo $rowsocial->facebookLink; ?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="<?php echo $rowsocial->twitterLink; ?>" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                <a href="<?php echo $rowsocial->linkedinLink; ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                <a href="<?php echo $rowsocial->mySpace; ?>" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
                <a href="<?php echo $rowsocial->otherLink1; ?>" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
                </div>
        </div>
        
        
        </div>
        
    </div>
</div>

<div class="copyright">                	
    <div class="bttxt">Copyright &copy; <?=date('Y')?> <?php echo $this->project_model->projectName();?>. All rights are reserved. <b>POWERED BY</b> <a href="https://www.indiasoftwares.in/" style="color: #59c517;" target="_blank">INDIA SOFTWARES</a></div>
</div>