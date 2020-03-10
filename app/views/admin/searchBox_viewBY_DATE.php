<?php
$currentDataCalendar = getCurrentDateCalendar();
$calendarEndLimit = date('Y');
$calendarStartLimit = ($calendarEndLimit-70);
?>
<link href="<?=base_url()?>btPublic/admin/venders/calendar/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?=base_url()?>btPublic/admin/venders/calendar/js/jquery-1.8.3.js"></script>
<script src="<?=base_url()?>btPublic/admin/venders/calendar/js/jquery-ui.js"></script>

<script>
	$(function() {
		
		$(function() {
			$( "#SEARCH_DTA" ).datepicker({
				changeYear: true,
				changeMonth: true,
				yearRange: '<?=$calendarStartLimit?>:<?=$calendarEndLimit?>',
				maxDate: '<?=$currentDataCalendar?>'
			});
		});				
	});
</script>
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
