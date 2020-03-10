<!doctype html>
<html class="no-js" lang="zxx">
		<!-- //Header -->
		<?=$this->load->view('pvcprint/include/header')?>

		<!-- Page Conent -->
	   
		<div class="container pb-5 ">
			 <h2 class="text-center aadhar-content pt-5 pb-5" ><u>PAY FOR AADHAR PVC CARD PRINT</u></h2>
			<table class="table table-striped ">
				<tbody>
					<tr class="table-light ">
						<th scope="row">Printing Charge</th>
			   			<td id="pay-table">50 ₹ </td>
					</tr>
					<tr class="table-light">
						<th scope="row">Packing, Handling And Postal Charge</th>
						<td id="pay-table">60 ₹</td>
				    </tr>
					<tr class="table-light">
						<th scope="row">Tax 18%</th>
						<td id="pay-table">21 ₹</td>
					</tr>
					<tr class="table-active">
						<th scope="row">Total</th>
						<td id="pay-table">131 ₹</td>
					</tr>
				</tbody>
			</table>
			<div class="container text-center pt-4">
				<button type="button" class="btn btn-success btn-lg">Make Payment</button>
			</div>
		</div>
		<!-- Footer Area -->
		<?=$this->load->view('pvcprint/include/footer')?>
</body>

</html>	