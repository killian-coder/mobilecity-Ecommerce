<?php 
    require_once 'core/init.php';
    include 'includes/head.php'; 
    include 'includes/navbar_airtel.php';

  $trans = 'TN20148994';
  $rand = rand(100,78);
  $transaction_id = $trans.$rand;


 if(empty($cart_id)):?>
	<p class="text-center text-success">your shopping cart is empty</p>
<?php else: 
$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$results = mysqli_fetch_assoc($cartQ);
$items = json_decode($results['items'],true);
$sub_total = 0;


?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			
		</div>
		


		<div class="col-md-8">
			<div><h3 class="text-center w3-red">you have the following items ready to be bought using airtel money<h3></div><br>
		<table class="table table-condensed" >
	<tbody>
		<?php foreach ($items as $item):

			$productQ = $db->query("SELECT * FROM products WHERE id = '{$item['id']}'");
			$product = mysqli_fetch_assoc($productQ); 
		?>
		<tr>
			<td><?=$item['quantity'];?></td>
			<td><?=substr($product['title'],0,15);?></td>
			<td><?=money($item['quantity'] * $product['price']);?></td>
		</tr>
	<?php 
	$sub_total += ($item['quantity'] * $product['price']);
	endforeach; ?>
	<tr>
		<td></td>
		<td>Sub Total</td>
		<td><?=money($sub_total);?></td>
	</tr>
	</tbody>
</table>

<?php endif; ?>

<h2 class="text-center">thank you for using airtel money</h2>
			<p>how to use my airtel money?</p>
			<ul class="text-danger">
				<li>Send money to our mobile money account using your <i class=" glyphicon glyphicon-phone "></i> phone account mobile number 0978467761 </li>
				<li>After sending the money copy the transaction ID which will be on your phone and provide it in the form below</li>
				<li>fill in the form and sumbit </li>
				<li> After submiting the form generate an invoice and wait for 30min max for the comfirmation of your purchase</li>
			</ul><br><br>


<?php  

if(isset($_POST['submit'])){
  $customer_name= $_POST['customer_name'];
  $customer_address = $_POST['customer_address'];
  $customer_nrc = $_POST['customer_nrc'];
  $gender = $_POST['gender'];
  $phone_number = $_POST['phone_number'];
  $delivery_address = $_POST['delivery_address'];
  $reference_number = $_POST['reference_number'];
  $date = $_POST['date'];



$insertsqli = "INSERT INTO `mobile_money` (`id`, `transaction_id`, `reference_number`, `customer_name`, `customer_address`, `customer_nrc`, `purchase_request`, `cart_id`, `phone_number`, `gender`,`delivery_address`) VALUES (NULL, '$transaction_id', '$reference_number', '$customer_name', '$customer_address', '$customer_nrc', '0', '$cart_id', '$phone_number', '$gender','$delivery_address');";

// $insertsqli = "INSERT INTO `mobile_money` (`transaction_id`, `reference_number`, `customer_name`, `customer_address`, `customer_nrc`, `purchase_request`, `cart_id`, `phone_number`,`gender`) VALUES (NULL, '23', '$reference_number', '$full_name', '$customer_address', '$customer_nrc', '0', '$cart_id', '$phone_number','$gender')";
$result = $db->query($insertsqli);
if($result){
  echo "Data inserted";
}else{
  echo "<h3 class='text-danger'>data not insert</h3>";
} 
}
?>
	
		
  <form class="form w3-container" role="form" action="" method="post">
  <label class="w3-text-blue">Full name:</label> <br>
  <input type="text" name="customer_name" id="customer_name" class="w3-input w3-border"><br>

  <label class="w3-text-blue">Address:</label> <br>
  <input type="text" name="customer_address" id="customer_address" class="w3-input w3-border" ><br>

  <label class="w3-text-blue">NRC Number/drivers liecence:*</label> <br>
  <input type="text" name="customer_nrc" id="customer_nrc" class="w3-input w3-border"><br>
  <label class="w3-text-blue">Gender:</label> <br>
  <input type="text" name="gender" id="gender" class="w3-input w3-border"><br>

  <label class="w3-text-blue">Delivery Address:*</label> <br>
  <input type="text" name="delivery_address" id="delivery_address" class="w3-input w3-border"><br>

  <label class="w3-text-blue">Reference Number:*</label> <br>
  <input type="text" name="reference_number" id="reference_number" class="w3-input w3-border"><br>
 

  <label class="w3-text-blue"><i class="fa fa-phone"></i> phone number:*</label> <br>
  <input type="text" name="phone_number" id="phone_number" class="w3-input w3-border"><br>
  <label class="w3-text-blue"><i class="fa fa-phone"></i>Date:*</label> <br>
  <input type="date" name="date" id="date" class="w3-input w3-border"><br>
  <br>
  <br>
  
 <button type="submit" class="btn btn-primary btn-lg w3-btn w3-blue" name="submit" style="float:center;"><span class="fa fa-send">submit</span></button>
 <br><br><br>
</form>


		</div>
		<div class="col-md-2">
			
		</div>

		
	</div>
</div>
