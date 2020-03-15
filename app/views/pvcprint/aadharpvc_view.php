<!doctype html>
<html class="no-js" lang="zxx">
		<!-- //Header -->
		<?=$this->load->view('pvcprint/include/header')?>

		<!-- Page Conent -->
<div class="container-fluid">
    <div class="container">
	  <h2 class="text-center aadhar-content pt-5" ><u>APPLY FOR <?=$heading?></u></h2>
	  <form action="<?=base_url().'pvcprint/pay?p='.$service?>" method="post" enctype="multipart/form-data">
		<div class="form-group-row">
			<div class="form-group row pt-3	 text-center">
			   <label for="staticEmail" class="col-form-label col-sm-2 aadhar-label">Name</label>
				<div class="col-sm-4 ">
				   <input type="text" class="form-control" id="staticEmail" >
				</div>
			   <label for="staticEmail" class="col-form-label col-sm-2 aadhar-label">Contact Number</label>
				<div class="col-sm-3">
				   <input type="tel" id="inputAddress" class="form-control" >
				</div>
		    </div>
	    </div>
	   <div class="form-group-row pt-3 ">
         <div class="form-group row  text-center">
         	  <label  class="col-form-label col-sm-2 aadhar-label">Address For Portal</label>
         	  <div class="col-sm-9 ">
				   <textarea class="form-control"  name="address" rows="4" cols="4"></textarea>
				</div>
         </div>
	   </div> 
	   <div class="form-group-row pt-3 ">
         <div class="form-group row  text-center">
         	  <label  class="col-form-label col-sm-2 aadhar-label">Password</label>
         	  <div class="col-sm-9 ">
				   <input type="text" class="form-control"  >
				</div>
         </div>
	   </div> 
        <div class="form-group pb-5">
           <label class="upload-aadhar">Upload File:</label>
           <input type="file" id='real-life' name="myfile" hidden/>
            <button type="button" id="custom-button" class="btn btn-outline-dark btn-lg btn-block">
            	<i class="fa fa-plus pd-5"></i> Upload</button>
            <span id="custom-text">No file choosen yet</span>

            <div class="container text-center pt-4">
				<button type="submit" class="btn btn-success btn-lg">Make Payment</button>
			</div>
        </div>
	  </form>
	</div>
</div>
		
		<!-- Footer Area -->
		<?=$this->load->view('pvcprint/include/footer')?>
</body>
	<script type="text/javascript">
		var realFileBtn = document.getElementById("real-life");
		var customBtn = document.getElementById("custom-button");
		var customTxt = document.getElementById("custom-text");
      
      customBtn.addEventListener("click",function() {
      	realFileBtn.click();
      });

      realFileBtn.addEventListener("change",function(){
         if (realFileBtn.value) {
         	customTxt.innerHTML = realFileBtn.value;
         }else {
         	customTxt.innerHTML = "No file choosen yet.";
         }
      });
	</script>
</html>	