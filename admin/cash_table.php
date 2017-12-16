<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Project_ecommerce/core/init.php';
if(!is_logged_in()){
  	login_error_redirect();
  }
include 'includes/head.php';
include 'includes/navigation.php';
$sql = "SELECT * FROM cash_on_delivery";
$res = $db->query($sql);

// restore a PRODUCT
$sql2 ="SELECT * FROM cash_on_delivery";
$presults = $db->query($sql2);

if(isset($_GET['restore'])){
	// echo $_GET['restore']; die();
	$id =sanitize($_GET['restore']);
	$restoredsql = "DELETE cash_on_delivery WHERE id = '$id'";
	$db->query($restoredsql);
	//header('Location: archieved.php');
}
if(isset($_GET['delete'])){
	$id = sanitize($_GET['delete']);
	$deletesql = "DELETE FROM cash_on_delivery WHERE id = '$id'";
	$db->query($deletesql);
	//header('Location: archieved.php');
}

?>
<div>
	<br><br><br>
<table class="table table-bordered table-striped table-condensed">
	<h1 class="text-center">Cash Transactions</h1>
<button type="button" class="btn btn-success"><a href="transactions/cash_transaction.php">Generate a report</a></button>
	<br><br>
	<thead><th></th> <th>id</th> <th>first name</th> <th>last name</th> <th>Nrc</th> <th>Phone Number</th> <th>current address</th></thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($res)): ?>
			<tr>
				<td>
					<a href="archieved.php?restore=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a>

					<a href="archieved.php?delete=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-trash"></span></a>
				</td>

				<td><?=$product['id']; ?></td>
				<td><?=$product['firstname'];?></td>
				<td><?php echo $product['last_name']; ?></td>
				<td><?php echo $product['nrc_number']; ?></td>
				<td><?php echo $product['phone_number']; ?></td>
				<td><?php echo $product['current_address']; ?></td>

		<?php endwhile; ?>	
	</tbody>

</table>

</div>

<?php include 'includes/footer.php'; ?>