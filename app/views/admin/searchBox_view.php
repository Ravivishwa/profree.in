<?php
$searchValue = '';
$searchReults = 'Search:';
$sessionName = $controller__Name.'SEARCH_SESS';

if((bool)($this->session->userdata($sessionName)) == TRUE){
	$searchValue = $this->session->userdata($sessionName);
	$searchReults = 'Search: <a href="'.base_url().'admin/general/clearSearchDATA/'.$controller__Name.'" title="Sow All / Clear Search Results ??">Clear search <img src="'.base_url().'btPublic/admin/images/delete.png"></a>';
}

?>
	<label class="search_results"><?=$searchReults?></label>
    
	<form action="<?=base_url().'admin/general/SearchDATA/'.$controller__Name?>" onsubmit="return validateSearchForm();">
        <div style="float:left;"><input type="text" name="SEARCH_DTA" id="SEARCH_DTA" class="search_top"  onkeypress="clearSearchField();"  value="<?=$searchValue?>" /></div>
        <div style="float:left;"><input type="image" src="<?=base_url()?>btPublic/admin/images/btn-search1.png" style="float:left;"  /></div>
	</form>
