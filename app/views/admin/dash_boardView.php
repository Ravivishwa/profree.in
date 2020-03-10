<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>btPublic/admin/css/style.css" />
</head>
<body style="background:#f6f6f6;">
	<?=$this->load->view('admin/header');?>
<div class="wrapper">
    <?=$this->load->view('admin/left_bar_linksView')?>
    <div class="rightbar">
        	<div class="heading"><?=$heading?></div>
            
            <div class="grid-bg" style="padding:10px 10px 10px 10px; height:975px; width:875px;">
            	
                Welcome to <strong><?=$this->project_model->projectName()?>:</strong>
                <div class="pixel_space1"></div>                
                <div style="margin-top:5px; color:#d20000; font-weight:bold; font-size:22px;">Quick Links:</div>
                
                
				<?php if(isSuperAdmin()){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/agents'?>"><img src="<?=base_url()?>btPublic/admin/images/agents2.png"  width="128" height="128"/><br/>Agents / Members</a></div>
				<?php
				}
				?>                
                
                <?php if($this->general_model->isModuleEnabled('property')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/property'?>"><img src="<?=base_url()?>btPublic/admin/images/cities.png"  width="128" height="128"/><br/>Manage Properties</a></div>                    
				<?php
				}
				?>
                
                <?php if($this->general_model->isModuleEnabled('favourites')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/favourites'?>"><img src="<?=base_url()?>btPublic/admin/images/gallery.png"  width="128" height="128"/><br/>Favourites</a></div>                    
				<?php
				}
				?>
                
                <?php if($this->general_model->isModuleEnabled('content')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/content'?>"><img src="<?=base_url()?>btPublic/admin/images/content1.png" /><br/>Content</a></div>                    
				<?php
				}
				?> 
                
				<?php if($this->general_model->isModuleEnabled('payment')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/payment'?>"><img src="<?=base_url()?>btPublic/admin/images/content1.png"  width="128" height="128"/><br/>Payment Plans</a></div>
				<?php
				}
				?>
				
				<?php if($this->general_model->isModuleEnabled('news')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/news'?>"><img src="<?=base_url()?>btPublic/admin/images/news.png"  width="128" height="128"/><br/>Advertisement</a></div>
				<?php
				}
				?>
                                               
                                                           
				
                <?php if($this->general_model->isModuleEnabled('socialLinks')){?>
                <div  style="margin-left:10px;" class="quick_links" align="center"><a href="<?=base_url().'admin/socialLinks'?>"><img src="<?=base_url()?>btPublic/admin/images/social-links.png"  width="128" height="128"/><br/>Social Links</a></div>                     
				<?php
				}
				?>
                
				
				<?php if($this->general_model->isModuleEnabled('countries')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/countries'?>"><img src="<?=base_url()?>btPublic/admin/images/content1.png"  width="128" height="128"/><br/>Manage Countries</a></div>
				<?php
				}
				?>
				
				<?php if($this->general_model->isModuleEnabled('cities')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/cities'?>"><img src="<?=base_url()?>btPublic/admin/images/content1.png"  width="128" height="128"/><br/>Manage Cities</a></div>
				<?php
				}
				?>
				
                               
                <?php if($this->general_model->isModuleEnabled('settings')){?>
                <div class="quick_links" align="center"><a href="<?=base_url().'admin/settings'?>"><img src="<?=base_url()?>btPublic/admin/images/settings.png"  width="128" height="128"/><br/>Settings</a></div>
				<?php
				}
				?>
                
                <div class="clear"></div>
                <div class="pixel_space4"></div><div class="pixel_space4"></div>
                <div class="clear"></div>
            </div>
            
        </div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
<?=$this->load->view('admin/footerView')?>
</body>
</html>
