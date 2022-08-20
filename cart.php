<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headpartial.php';

if ($cart_id != '') {
	$cartQ = $db->query("SELECT * FROM cart WHERE id = ' {$cart_id}'");
	$result = mysqli_fetch_assoc($cartQ);
	$items = json_decode($result['items'], true);
	$i = 1;
	$Sub_total = 0;
	$item_count = 0;
	$tax = '';
}
?>
<div class="col-md-12">
	<div class="row">
		<h2 class="text-center">My Shopping Cart</h2>
		<hr>

		<?php if ($cart_id == '') : ?>
			<div class="bg-danger">
				<p class="text-center text-danger">
					Your shopping cart is empty!
				</p>
			</div>
		<?php else : ?>
			<table class="table table-bordered table-condensed table-striped">
				<thead>
					<th>#</th>
					<th>item</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>size/type</th>
					<th>Sub Total</th>
				</thead>
				<tbody>
					<?php
					foreach ($items as $item) {
						$product_id = $item['id'];
						$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
						$product = mysqli_fetch_assoc($productQ);
						$sArray = explode(',', $product['sizes']);
						foreach ($sArray as $sizeString) {
							$s = explode(':', $sizeString);
							if ($s[0] == $item['size']) {
								$available = $s[1];
							}
						}
					?>
						<tr>
							<td><?= $i; ?></td>
							<td><?= $product['title']; ?></td>
							<td><?= money($product['price']); ?></td>
							<td>
								<button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?= $product['id']; ?>','<?= $item['size']; ?>');">-</button>
								<?= $item['quantity']; ?>
								<?php if ($item['quantity'] < $available) : ?>
									<button class="btn btn-xs btn-default" onclick="update_cart('addone','<?= $product['id']; ?>','<?= $item['size']; ?>');">+</button>
								<?php else : ?>
									<span class="text-danger">Max Reached</span>

								<?php endif; ?>
							</td>
							<td><?= $item['size']; ?></td>
							<td><?= money($item['quantity'] * $product['price']); ?></td>
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
				</tbody>
			</table>
			<table class="table table-bordered table-condensed text-right">
				<legend>Totals</legend>
				<thead class="totals-table-header">
					<th>Total items</th>
					<th>Sub_Total</th>
					<th>Tax</th>
					<th>Grand Total</th>
				</thead>
				<tbody>
					<tr>
						<td><?= $item_count; ?></td>
						<td><?= money($Sub_total); ?></td>
						<td><?= money($tax); ?></td>
						<td class="bg-success"><?= money($grand_total); ?></td>

					</tr>
				</tbody>
			</table>
			<!-- check out Button -->
			<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#checkoutModal">
				<span class="glyphicon glyphicon-shopping-cart"></span> Check out >>
			</button>

			<!--////////////////////////////////////////////////////// Modal///////////////////////////////////// -->
			<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="checkoutModalLabel">Shipping Adderess</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="payment-form">
									<span class="bg-danger" id="payment-errors"></span>
									<div id="step1" style="display:block;">
										<div class="form-group col-md-6">
											<label for="full_name">Full name:</label>
											<input type="text" class="form-control" id="full_name" name="full_name">
										</div>
										<div class="form-group col-md-6">
											<label for="email">Email:</label>
											<input type="Email" class="form-control" id="email" name="email">
										</div>
										<div class="form-group col-md-6">
											<label for="street">street Address:</label>
											<input type="text" class="form-control" id="street" name="street">
										</div>
										<div class="form-group col-md-6">
											<label for="street2">street Adress:</label>
											<input type="text" class="form-control" id="street2" name="street2">
										</div>
										<div class="form-group col-md-6">
											<label for="city">City:</label>
											<input type="text" class="form-control" id="city" name="city">
										</div>
										<div class="form-group col-md-6">
											<label for="province">Province:</label>
											<input type="text" class="form-control" id="province" name="province">
										</div>
										<div class="form-group col-md-6">
											<label for="zipcode">Zip Code:</label>
											<input type="text" class="form-control" id="zipcode" name="zipcode">
										</div>
										<div class="form-group col-md-6">
											<label for="country">Country:</label>
											<input type="text" class="form-control" id="country" name="country">
										</div>
									</div>

									<div id="step2" style="display:none; background-color: #339cff;">
										<div class="col-md-12" style="background-color: #339cff;">
											<h1 class="text-center">Choose your payment plan</h1><br>
											<h6 class="text-center"><a href="thank_you.php" data-toggle="tooltip" title="you almost done"><em> click here to finish your purchase </em></a></h1>

												<a type="button" href="cash_purchase.php" class="btn btn-sm btn-primary">buy Now</a>

												<!-- <a href="thank_you.php" data-toggle="tooltip" title="you almost done !"><span class=" fa fa-credit-card fa-f8"></span></a> -->

										</div>

									</div>

							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" onclick="check_address();" id="next_button">Next>> </button>
							<button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display:none;">
								<< Back </button>
									<!-- <button type="submit" class="btn btn-primary" id="checkout_button" style="display:none;">Check out button </button> -->
									</form>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<br><br><br>

<script>
	function back_address() {
		jQuery('#payment-errors').html("");
		jQuery('#step1').css("display", "block");
		jQuery('#step2').css("display", "none");
		jQuery('#next_button').css("display", "inline-block");
		jQuery('#back_button').css("display", "none");
		jQuery('#checkout_button').css("display", "none");
		jQuery('#checkoutModalLabel').html("shipping Address");

	}

	function check_address() {
		var data = {
			'full_name': jQuery('#full_name').val(),
			'email': jQuery('#email').val(),
			'street': jQuery('#street').val(),
			'street2': jQuery('#street2').val(),
			'city': jQuery('#city').val(),
			'province': jQuery('#province').val(),
			'zipcode': jQuery('#zipcode').val(),
			'country': jQuery('#country').val(),

		};

		jQuery.ajax({
			url: '/mobilecity-Ecommerce/admin/parsers/check_address.php',
			type: 'POST',
			data: data,
			success: function(data) {
				if (data != 'passed') {
					jQuery('#payment-errors').html(data);


				}
				if (data == 'passed') {
					jQuery('#payment-errors').html("");
					jQuery('#step1').css("display", "none");
					jQuery('#step2').css("display", "block");
					jQuery('#next_button').css("display", "none");
					jQuery('#back_button').css("display", "inline-block");
					jQuery('#checkout_button').css("display", "inline-block");
					jQuery('#checkoutModalLabel').html("<h2>Continue to your payments<h2>");

				}
			},
			error: function() {
				alert('somthing went horribly wrong ')
			},
		});
	}


	// $(document).ready(function(){
	//     $('[data-toggle="tooltip"]').tooltip();
	// });
</script>

<?php include 'includes/footer.php'; ?>