<!doctype html>
<?php


$userid = $this->session->userdata('agentId');
$name = $this->session->userdata('userName');
$email = $this->session->userdata('email');
$baseurl = base_url();
?>
<html class="no-js" lang="zxx">
		<!-- //Header -->
		<?=$this->load->view('pvcprint/include/header')?>

		<!-- Page Conent -->
        <form name="f1" method="post" action="<?=base_url().'pvcpaymentinsta/pay.php'?>">
		<div class="container pb-5 ">
			 <h2 class="text-center aadhar-content pt-5 pb-5" ><u>PAY FOR <?=$service?></u></h2>
			<table class="table table-striped ">
				<tbody>
					<tr class="table-light ">
						<th scope="row">Printing Charge</th>
			   			<td id="pay-table"><?=$price?>₹ </td>
					</tr>
					<tr class="table-light">
						<th scope="row">Packing, Handling And Postal Charge</th>
						<td id="pay-table"><?=$others?> ₹</td>
				    </tr>
					<tr class="table-light">
						<th scope="row">Tax</th>
						<td id="pay-table"><?=$tax?> %</td>
					</tr>
					<tr class="table-active">
						<th scope="row">Total</th>
						<td id="pay-table"><?=$total?> ₹</td>
					</tr>
				</tbody>
			</table>
            <input type="hidden" name="price" value="<?= $total;?>">
            <input type="hidden" name="name" value="<?= $name;?>">
            <input type="hidden" name="email" value="<?= $email;?>">
            <input type="hidden" name="userid" value="<?= $userid;?>">
            <input type="hidden" name="service" value="<?= $service;?>">

            <input type="hidden" name="phone" value="<?= $phone;?>">
            <input type="hidden" name="request_name" value="<?= $request_name;?>">
            <input type="hidden" name="request_password" value="<?= $request_password;?>">
            <input type="hidden" name="request_address" value="<?= $request_address;?>">
            <input type="hidden" name="file_name" value="<?= $file_name;?>">
            <input type="hidden" name="baseurl" value="<?= $baseurl;?>">



			<div class="container text-center pt-4">
				<button type="submit" class="btn btn-success btn-lg">PAY</button>
			</div>
		</div>
        </form>
		<!-- Footer Area -->
		<?=$this->load->view('pvcprint/include/footer')?>
</body>

</html>
