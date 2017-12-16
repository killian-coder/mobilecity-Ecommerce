<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Project_ecommerce/core/init.php';
if(!is_logged_in()){
  	login_error_redirect();
  }
include 'includes/head.php';
include 'includes/navigation.php';
$sql = "SELECT * FROM products WHERE deleted = 1";
$res = $db->query($sql);

// restore a PRODUCT
$sql2 ="SELECT * FROM products";
$presults = $db->query($sql2);

if(isset($_GET['restore'])){
	// echo $_GET['restore']; die();
	$id =sanitize($_GET['restore']);
	$restoredsql = "UPDATE products SET deleted = 0 WHERE id = '$id'";
	$db->query($restoredsql);
	header('Location: archieved.php');
}
if(isset($_GET['delete'])){
	$id = sanitize($_GET['delete']);
	$deletesql = "DELETE FROM products WHERE id = '$id'";
	$db->query($deletesql);
	header('Location: archieved.php');
}

?>
<div>
	<br>
<table class="table table-bordered table-striped table-condensed">
	<thead><th></th><th>Product</th><th>Price</th><th>Category</th></thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($res)): ?>
			<tr>
				<td>
					<a href="archieved.php?restore=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a>

					<a href="archieved.php?delete=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-trash"></span></a>
				</td>

				<td><?php echo $product['title']; ?></td>
				<td><?php echo money($product['price']);?></td>

		<?php endwhile; ?>	
	</tbody>

</table>

</div>

<?php include 'includes/footer.php'; ?>