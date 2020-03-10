<style type="text/css">
.uitabs .nav-tabs > li a{
	cursor:pointer;	
}
</style>
<script type="application/javascript">
function select_type(ID){
	//document.getElementById('Sale').className = 'test';
	//document.getElementById('Rent').style.background = '#333b86';
	//document.getElementById('Wanted').style.background = '#333b86';
	
	//document.getElementById(ID).style.background = '#000';
	document.getElementById('type').value = ID;
}
</script>


<div class="searchWraper">
<div class="searchsection">
<div class="container">        
        <h1>Find Your Dream Property</h1>
        <h2  style="text-decoration: underline;">Pro Free India Is A Largest Exclusive Property Searching Portal</h2>
        
        
                          
               
               <div class="typewrap">
               <ul class="uitabs">
                  <li>
                    <input type="radio" id="f-option" name="selector" onclick="select_type('Sale');">
                    <label for="f-option">For Sale</label>                    
                    <div class="check"></div>
                  </li>
                  
                  <li>
                    <input type="radio" id="s-option" name="selector" onclick="select_type('Rent');">
                    <label for="s-option">To Rent</label>                    
                    <div class="check"><div class="inside"></div></div>
                  </li>
                  
                  <li>
                    <input type="radio" id="t-option" name="selector" onclick="select_type('Wanted');">
                    <label for="t-option">Wanted</label>                    
                    <div class="check"><div class="inside"></div></div>
                  </li>
                </ul>
               </div>

          
          <div class="formwrap">            
            <form action="<?=base_url().'search/property'?>" method="get">
                <div class="row">
                <div class="col-md-6 col-sm-6 marginbtm"><input type="text" name="location" id="location" class="form-control" placeholder="Proeprty Location" /></div>
                <div class="col-md-6 col-sm-6 marginbtm">
                	<select name="sub_type" id="sub_type" class="form-control">
                        <option value="">Property Type</option>
                        <option value="Homes">--------- Homes ---------</option>
                        <option value="Houses">Houses</option>
                        <option value="Flats">Flats</option>
                        <option value="Upper Portions">Upper Portions</option>
                        <option value="Lower Portions">Lower Portions</option>
                        <option value="Farm Houses">Farm Houses</option>
                        <option value="Rooms">Rooms</option>
                        <option value="Penthouse">Penthouse</option>
                        
                        <option value="Plots">--------- Plots ---------</option>
                        <option value="Residential Plots">Residential Plots</option>
                        <option value="Commercial Plots">Commercial Plots</option>
                        <option value="Agricultural Land">Agricultural Land</option>
                        <option value="Industrial Land">Industrial Land</option>
                        <option value="Plot Forms">Plot Forms</option>
                        
                        <option value="Commercial">--------- Commercial ---------</option>
                        <option value="Offices">Offices</option>
                        <option value="Shops">Shops</option>
                        <option value="Warehouses">Warehouses</option>
                        <option value="Factories">Factories</option>
                        <option value="Buildings">Buildings</option>
                        <option value="Other">Other</option>
                    </select>
               	</div>
                </div>
                
                <div class="row">
                <div class="col-md-3 col-sm-6 marginbtm">
                    <input type="text" name="price_from" id="price_from" class="form-control" placeholder="Price From" />
                </div>
                <div class="col-md-3 col-sm-6 marginbtm">
                    <input type="text" name="price_to" id="price_to" class="form-control" placeholder="Price To" />
                </div>
                <div class="col-md-3 col-sm-6 marginbtm">
                    <select class="form-control" name="bedrooms" id="bedrooms">
                        <option value="">Number of Beds</option>
                        <?php
						for($i=1; $i<=10; $i++){
							?>
							<option value="<?=$i?>"><?=$i?></option>
							<?php
						}
						?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 marginbtm">
                    <select class="form-control" name="bathrooms" id="bathrooms">
                        <option value="">Numer of Bathrooms</option>
                        <?php
						for($i=1; $i<=10; $i++){
							?>
							<option value="<?=$i?>"><?=$i?></option>
							<?php
						}
						?>
                    </select>
                </div>
                
                </div>
                <div class="searchbtn">
                    <!--<a href="#">Advanced seach options</a>-->                    
                    <input type="hidden" name="type" id="type" value=""/>
                    <input type="submit" value="Find Property" />
                </div>
                <div style="clear:both;"></div>
            </form>
          </div>          
            
        </div>
</div>
</div>
<script>select_type('Sale'); document.getElementById('f-option').checked = "checked"</script>