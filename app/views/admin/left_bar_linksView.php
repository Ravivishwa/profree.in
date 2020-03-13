<?php
if(isSuperAdmin()){
	?>
<div class="leftbar">

    <ul>



        <li><a href="<?=base_url()?>admin/dashboard" <?=selectLink('dashboard', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/dash.jpg" />Dashboard</a></li>


		<?php
		if(isSuperAdmin()){
		?>
				<li><a href="<?=base_url()?>admin/agents" <?=selectLink('agents', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/agents2.png" />Manage Agents / Memebers</a></li>
			<?php
		}


		if($this->general_model->isModuleEnabled('property')){

		?>

        	<li><a href="<?=base_url()?>admin/property" <?=selectLink('property', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/gallery.png" />Manage Properties</a></li>

      	<?php

		}

		if($this->general_model->isModuleEnabled('favourites')){

		?>

        	<li><a href="<?=base_url()?>admin/favourites" <?=selectLink('favourites', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/gallery.png" />Favourites</a></li>

      	<?php

		}

		if($this->general_model->isModuleEnabled('content')){
			?>

				<li><a href="<?=base_url()?>admin/content" <?=selectLink('content', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/content1.png" />Manage Content</a></li>

			<?php

		}

		if($this->general_model->isModuleEnabled('payment')){?>

				<li><a href="<?=base_url()?>admin/payment" <?=selectLink('payment', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/content1.png" />Payment Plans</a></li>

			<?php

		}

		if($this->general_model->isModuleEnabled('news')){?>

				<li><a href="<?=base_url()?>admin/news" <?=selectLink('news', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/news.png" />Manage Advertisement</a></li>

			<?php

		}





		if($this->general_model->isModuleEnabled('socialLinks')){

		?>

        	<li><a href="<?=base_url()?>admin/socialLinks" <?=selectLink('socialLinks', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/social-links.png" />Social Links</a></li>

      	<?php

		}



		if($this->general_model->isModuleEnabled('cities')){

		?>

        	<li><a href="<?=base_url()?>admin/cities" <?=selectLink('cities', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/cities.png" />Manage Cities</a></li>

        <?php

		}

		if($this->general_model->isModuleEnabled('countries')){
		?>

        	<li><a href="<?=base_url()?>admin/countries" <?=selectLink('countries', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/countries.png" />Manage Countries</a></li>
        <?php
		}

		if(isSuperAdmin()){

		?>

        	<li><a href="<?=base_url()?>admin/settings" <?=selectLink('settings', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/settings.png" />Settings</a></li>

        	<li><a href="<?=base_url()?>admin/pvcpayment" <?=selectLink('pvcpayment', $pageName)?> ><img src="<?=base_url()?>btPublic/admin/images/icons-short/settings.png" />PVC Print Settings</a></li>

        <?php

		}

		?>

    </ul>

</div>
<?php
}
?>
