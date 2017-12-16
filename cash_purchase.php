<?php
require_once 'core/init.php';
include 'includes/navbar4.php';

if ($cart_id != '') {
	$cartQ = $db->query("SELECT * FROM cart WHERE id = ' {$cart_id}'");
	$result = mysqli_fetch_assoc($cartQ);
	$items = json_decode($result['items'],true);
	$i = 1;
	$tax ='';
	$Sub_total = 0;
	$item_count = 0;
}

?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-2">
		<h2>more products</h2>
		<div class="col-md-12"> 
			<p>headsets</p>
		 <img src="image/ADpix/headsets.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

		 <div class="col-md-12"><p>New phone :</p>
		 <img src="image/ADpix/phone1.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

		 <div class="col-md-12"> <p> you can also check the following product:</p>
		 <img src="image/ADpix/headsets.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

		 <div class="col-md-12"> <p>headphones</p>
		 <img src="image/ADpix/headsets.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>


	 </div>
	<div class="col-md-8">
		<div class="panel panel-default">
		<div class="panel-heading" style="background-color:#000066;"></div> 
		<div class="panel-body">
			<p>product you have order</p><hr>
			<div class="row">

		<?php if($cart_id = ''): ?>
		<div class="bg-danger">
			<p class="text-center text-danger">
				Your shopping cart is empty!
			</p>
		</div>

	<?php else: ?>
		<div class="col-md-6">
		<table class="table-reciept">
	
		
			<?php
			foreach($items as $item){
				$product_id = $item['id'];
				$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
				$product = mysqli_fetch_assoc($productQ);
				$sArray = explode(',',$product['sizes']);
				foreach($sArray as $sizeString){
					$s = explode(':',$sizeString);
					if($s[0] == $item['size']){
						$available = $s[1];
					}
				}

			  ?>

			  <div class="col-md-6">
							<img src="<?=$product['image'];?>" class="img-thumbnail">

				</div>



			 <tr>
				<td>Product name:</td><td><?=$product['title'];?></td>
			</tr>

			<tr>
				<td>Type/size:</td><td><?=$item['size'];?></td>
			</tr>

			<tr>
				<td>quantity:</td><td><?=$item['quantity'];?></td>
			</tr>
			<tr>
				<td>Price:</td><td><?=money($item['quantity'] * $product['price']);?></td>
			</tr>
			
			 <?php
			  $i++;
			  $item_count += $item['quantity'];
			  $Sub_total += ($product['price'] * $item['quantity']); 
			} 
			$tax = TAXRATE * $Sub_total;
			$tax = 2;
			$grand_total = $tax + $Sub_total; 

			?>
		</table>
	</div>
	</div>
	</div>
	<div class="panel-footer" style="background-color:#000066;"></div>
	</div>


	<br><br><br>
	<?php
	if(isset($_POST['submit']))
{
  $firstname = $_POST['firstname'];
  $last_name = $_POST['last_name'];
  $nrc_number = $_POST['nrc_number'];
  $gender = $_POST['gender'];
  $phone_number = $_POST['phone_number'];
  $current_address = $_POST['current_address'];
  $address = $_POST['address'];
  $errors = array();
  $required =array(
  	'firstname'   => 'Full Name',
  	'last_name'   => 'last name',
	'nrc_number'  => 'nrc number',
'current_address' => 'current address',
);
foreach ($required as $f => $d) {
	if(empty($_POST[$f]) || $_POST[$f] == ''){
		$errors[] = $d. ' is required. ';
	}
}



$insertsql = "INSERT INTO `cash_on_delivery` (`id`, `firstname`, `last_name`, `nrc_number`, `phone_number`, `current_address`, `address`, `order_status`,`gender`,`Amount`) VALUES (NULL,'$firstname','$last_name','$nrc_number','$phone_number',' $address','$address','','$gender','$grand_total')";
$result = $db->query($insertsql);
if($result){
  echo "from succefully submitted";
}else{
  echo "your form did not submit plz chech that you";
} 
}

?>
<div class="container-fluid col-md-12">
	<h2 style="text-align:right; color:#39ac39;">Grand total: <?=money($grand_total);?></h2>
</div>

<form class="form" role="form" action="cash_purchase.php" method="post">
  <label>First name:*</label> <br>
  <input type="text" name="firstname" required="firstname" id="firstname" class="form-control" ><br>

  <label>Last name:*</label> <br>
  <input type="text" name="last_name" id="last_name" required="last_name" class="form-control" ><br>
  	<p>Enter the first 6 digit on your NRC</p>
  <label>NRC:*</label> <br>
  <input type="text" name="nrc_number" id="nrc_number"  required="nrc_number" class="form-control"><br>
 
  <label>Gender:*</label> <br>
  <input type="text" name="gender" id="gender" class="form-control" required="gender" placeholder="Male or famale"><br>
 

  <label>Address:</label> <br>
  <input type="text" name="address" id="Address" class="form-control"><br>
  <input type="hidden" name="<?=$grand_total;?>"  id="<?=$grand_total;?>">

  <label>Current Address:*</label> <br>
  <input type="text" name="current_address" id="current_address"  required="required" class="form-control"><br>

  <label>phone number:*</label> <br>
  <input type="text" name="phone_number" id="phone_number" required="phone_number" class="form-control"><br>
  <br>
  <br>
  
 <button type="submit" class="btn btn-primary btn-lg" name="submit" style="float:center;"><span class="fa fa-send">submit</span></button>
 <br><br><br>
</form>


</div>

<div class="col-md-2">
	<h2>more products</h2>
		<div class="col-md-12"> <p>phones</p>
		 <img src="image/ADpix/headsets.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

		 <div class="col-md-12"> <p>New phone :</p>
		 <img src="image/ADpix/phone1.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

		 <div class="col-md-12"> <p> you can also check the following product:</p>
		 <img src="image/ADpix/headsets.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

		 <div class="col-md-12"> <p></p>
		 <img src="image/ADpix/headsets.jpg" class="img-rounded" alt="headsets" width="170" height="150">
		 </div>

	
</div>
<br>
<br>
<br>
	<?php endif; ?>
</body>
</html>
