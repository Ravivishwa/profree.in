<?php
$type = '';
if($this->input->get('type')){
	$type = $this->input->get('type');
}
$sub_type = '';
if($this->input->get('sub_type')){
	$sub_type = $this->input->get('sub_type');	
}
$location = '';		
if($this->input->get('location')){
	$location = $this->input->get('location');
}
$price_from = '';
if($this->input->get('price_from')){
	$price_from = $this->input->get('price_from');	
}
$price_to = '';
if($this->input->get('price_to')){
	$price_to = $this->input->get('price_to');
}
$bedrooms = '';
if($this->input->get('bedrooms')){
	$bedrooms = $this->input->get('bedrooms');
}
$bathrooms = '';
if($this->input->get('bathrooms')){
	$bathrooms = $this->input->get('bathrooms');
}
$area = '';
if($this->input->get('area')){
	$area = $this->input->get('area');
}
$title = '';
if($this->input->get('title')){
	$title = $this->input->get('title');
}
?>
<div class="rignbarbox">
<div class="hedingbar">Refine your search</div>                        
<div class="boxinnr">
    <form action="<?=base_url().'search/property'?>" method="get">
        <div class="formbox">
        <label>Location</label>
        <input type="text" name="location" id="location" class="form-control" placeholder="Type Location" value="<?=$location?>" /></div>
        
        
        <div class="formbox">
        <label>Property Type</label>
        <select name="sub_type" id="sub_type" class="form-control">
        	<option value=""  <?php if($sub_type == '') echo 'selected';?>>All</option>
            <option value="Homes" <?php if($sub_type == 'Homes') echo 'selected'?>>--------- Homes ---------</option>
            <option value="Houses" <?php if($sub_type == 'Houses') echo 'selected'?>>Houses</option>
            <option value="Flats" <?php if($sub_type == 'Flats') echo 'selected'?>>Flats</option>
            <option value="Upper Portions" <?php if($sub_type == 'Upper Portions') echo 'selected'?>>Upper Portions</option>
            <option value="Lower Portions" <?php if($sub_type == 'Lower Portions') echo 'selected'?>>Lower Portions</option>
            <option value="Farm Houses" <?php if($sub_type == 'Farm Houses') echo 'selected'?>>Farm Houses</option>
            <option value="Rooms" <?php if($sub_type == 'Rooms') echo 'selected'?>>Rooms</option>
            <option value="Penthouse" <?php if($sub_type == 'Penthouse') echo 'selected'?>>Penthouse</option>
            
            <option value="Plots" <?php if($sub_type == 'Plots') echo 'selected'?>>--------- Plots ---------</option>
            <option value="Residential Plots" <?php if($sub_type == 'Residential Plots') echo 'selected'?>>Residential Plots</option>
            <option value="Commercial Plots" <?php if($sub_type == 'Commercial Plots') echo 'selected'?>>Commercial Plots</option>
            <option value="Agricultural Land" <?php if($sub_type == 'Agricultural Land') echo 'selected'?>>Agricultural Land</option>
            <option value="Industrial Land" <?php if($sub_type == 'Industrial Land') echo 'selected'?>>Industrial Land</option>
            <option value="Plot Forms" <?php if($sub_type == 'Plot Forms') echo 'selected'?>>Plot Forms</option>
            
            <option value="Commercial" <?php if($sub_type == 'Commercial') echo 'selected'?>>--------- Commercial ---------</option>
            <option value="Offices" <?php if($sub_type == 'Offices') echo 'selected'?>>Offices</option>
            <option value="Shops" <?php if($sub_type == 'Shops') echo 'selected'?>>Shops</option>
            <option value="Warehouses" <?php if($sub_type == 'Warehouses') echo 'selected'?>>Warehouses</option>
            <option value="Factories" <?php if($sub_type == 'Factories') echo 'selected'?>>Factories</option>
            <option value="Buildings" <?php if($sub_type == 'Buildings') echo 'selected'?>>Buildings</option>
            <option value="Other" <?php if($sub_type == 'Other') echo 'selected'?>>Other</option>
        </select>
        </div>
        
        <div class="formbox">
        <label>Purpose</label>
        <select name="type" id="type" class="form-control">
            <option value=""  <?php if($type == '') echo 'selected';?>>All</option>
<option value="Sale"  <?php if($type == 'Sale') echo 'selected';?>>Sale</option>
            <option value="Rent"  <?php if($type == 'Rent') echo 'selected';?>>Rent</option>
            <option value="Wanted"  <?php if($type == 'Wanted') echo 'selected';?>>Wanted</option>
        </select></div>
        
        <div class="formbox">
        <label>Beds</label>
        <select class="form-control" name="bedrooms" id="bedrooms">
            <option value="">Any</option>
            <?php
            for($i=1; $i<=10; $i++){
                ?>
                <option value="<?=$i?>" <?php if($bedrooms == $i) echo 'selected';?>><?=$i?></option>
                <?php
            }
            ?>
        </select>                               
        </div>
        
        
        <div class="formbox">
<label>Bathrooms</label>
        <select class="form-control" name="bathrooms" id="bathrooms">
            <option value="">Any</option>
            <?php
            for($i=1; $i<=10; $i++){
                ?>
                <option value="<?=$i?>" <?php if($bathrooms == $i) echo 'selected';?>><?=$i?></option>
                <?php
            }
            ?>
        </select>
        
        </div>
        
        <div class="formbox">
        <label>Price</label>
        <input type="text" name="price_from" id="price_from" class="form-control" value="<?=$price_from?>" placeholder="Price From" style="width:100px; float:left;" />
        <input type="text" name="price_to" id="price_to" class="form-control" value="<?=$price_to?>" placeholder="Price To" style="width:100px; margin-left:5px; float:left;" />
        <div style="clear:both;"></div>
        </div>
        
        <div class="formbox">
        <label>Land Area</label>
        <input type="text" name="area" id="area" class="form-control" value="<?=$area?>" placeholder="Squre metter, Squre yard etc." />
        </div>
        
        
        <div class="formbox">
        <label>Keywords / Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?=$title?>" placeholder="e.g. 'conservatory' or 'annexe'" /></div>
            
        
        <div class="formbox">
        <input type="submit" value="Refine Search" class="btn" /></div>
    </form>
</div>                        
</div>