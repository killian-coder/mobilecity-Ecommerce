<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/mobilecity-Ecommerce/core/init.php';
if(!is_logged_in()){
  	login_error_redirect();
  }
include 'includes/head.php';
include 'includes/navigation.php';

//delete product
if (isset($_GET['delete'])) {
	$id = sanitize($_GET['delete']);
	$db->query("UPDATE products SET deleted = 1 WHERE `id` = '$id'");
	header("Location: products.php");
}

$dbPath = '';
if(isset($_GET['add']) || isset($_GET['edit'])){
$brandQuery =  $db->query("SELECT * FROM brand ORDER BY brand");
$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY Category");
$title = ((isset($_POST['title']) && $_POST['title'] != '' )?sanitize($_POST['title']):'');
$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
$category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
$price = ((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):'');
$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '' )?sanitize($_POST['list_price']):'');
$description = ((isset($_POST['description']) && $_POST['description'] != '' )?sanitize($_POST['description']):'');
$sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '' )?sanitize($_POST['sizes']):'');
$sizes = rtrim($sizes,',');
$saved_image ='';


if(isset($_GET['edit'])){
	$edit_id = $_GET['edit'];
	$productResults = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
	$product = mysqli_fetch_assoc($productResults);
	if (isset($_GET['delete_image'])){
		$image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];echo $image_url;
		 unlink($image_url);
		 $db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
		 header('Location: products.php?edit='.$edit_id);	
	}

$category = ((isset($_POST['child']) && $_POST['child'] !='')?sanitize($_POST['child']):$product['categories']); 
$title =((isset($_POST['title']) && $_POST['title'] =! '')?sanitize($_POST['title']):$product['title']);
$brand =((isset($_POST['brand']) && $_POST['brand'] =! '')?sanitize($_POST['brand']):$product['brand']);
$parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
$parentResult = mysqli_fetch_assoc($parentQ); 
$parent =((isset($_POST['parent']) && $_POST['parent'] =! '')?sanitize($_POST['parent']):$parentResult['parent']);
$price =((isset($_POST['price']) && $_POST['price'] =! '')?sanitize($_POST['price']):$product['price']); 
$list_price =((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
$description =((isset($_POST['description']))?sanitize($_POST['description']):$product['description']); 
$sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '' )?sanitize($_POST['sizes']):$product['sizes']);
$sizes = rtrim($sizes,',');
$saved_image =(($product['image'] !='')?$product['image']:'');
$dbPath = $saved_image;

}
if (!empty($sizes)) {
		$sizeString = sanitize($sizes);
		$sizeString = rtrim($sizeString,',');
		$sizesArray = explode(',',$sizeString);
		$sArray = array();
		$qArray = array();
		foreach ($sizesArray as $ss){
			$s = explode(':', $ss);
			$sArray[] = $s[0];
			$qArray[] = $s[1];
		}
	}else{$sizesArray = array();}

if (isset($_POST['Add'])){
	$errors = array(); 
	$required = array('title', 'brand', 'price', 'parent','sizes');
	foreach ($required as $field){
		if($_POST[$field] == ''){
			$errors[] = 'All Field with Astrisk are required.';
			break;
		 }
		}
		if($_FILES['photo']['name'] != ''){
			$photo = $_FILES['photo'];
			$name = $photo['name'];
			$nameArray = explode('.',$name);
			$fileName = $nameArray[0];
			$fileExt =  $nameArray[1];
			$mime = explode('/',$photo['type']);
			$mimeType = $mime[0];
			$mimeExt = $mime[1];
			$tmpLoc = $photo['tmp_name'];
			$fileSize = $photo['size'];
			$allowed = array('png','jpg', 'jpeg', 'gif');
			$uploadName = md5(microtime()).'.'.$fileExt;
			$uploadPath = BASEURL.'image/products/'.$uploadName;
			$dbPath = '/mobilecity-Ecommerce/image/products/'.$uploadName;
			if($mimeType != 'image'){
				$errors[] = 'The file must be an image.';
			}
			if (!in_array($fileExt, $allowed)) {
				$errors[] = 'The photo extension must be png, jpg, jpeg, gif.';
			} 
			if ($fileSize > 25000000) {
			$errors[] = 'The file size must be under 15MB.';
			}
			if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
			$errors[] = 'File extension does not match the file';
			}
		}
		if(!empty($errors)){
			echo display_errors($errors);
			}else{
				//upload file and insert into database
				if(!empty($_FILES)){
					move_uploaded_file($tmpLoc, $uploadPath);
				}
				$insertsql = "INSERT INTO products (`title`, `price`, `list_price`, `brand`, `image`,`categories`,`description`,`sizes`) VALUES ('$title', '$price', '$list_price', '$brand','$dbPath', '$category','$description','$sizes')";
				
				$db->query($insertsql);
				header('Location: products.php');

			}
} 

if(isset($_POST['Edit'])){
	$edit_id = $_GET['edit'];
	$errors = array(); 
	$required = array('title', 'brand', 'price', 'parent','sizes');
	foreach ($required as $field){
		if($_POST[$field] == ''){
			$errors[] = 'All Field with Astrisk are required.';
			break;
		 }
		}
		if(!empty($_FILES)) {
			$photo = $_FILES['photo'];
			$name = $photo['name'];
			$nameArray = explode('.',$name);
			$fileName = $nameArray[0];
			$fileExt =  $nameArray[1];
			$mime = explode('/',$photo['type']);
			$mimeType = $mime[0];
			$mimeExt = $mime[1];
			$tmpLoc = $photo['tmp_name'];
			$fileSize = $photo['size'];
			$allowed = array('png','jpg', 'jpeg', 'gif');
			$uploadName = md5(microtime()).'.'.$fileExt;
			$uploadPath = BASEURL.'image/products/'.$uploadName;
			$dbPath = '/mobilecity-Ecommerce/image/products/'.$uploadName;
			if($mimeType != 'image'){
				$errors[] = 'The file must be an image.';
			}
			if (!in_array($fileExt, $allowed)) {
				$errors[] = 'The photo extension must be png, jpg, jpeg, gif.';
			} 
			if ($fileSize > 25000000) {
			$errors[] = 'The file size must be under 15MB.';
			}
			if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
			$errors[] = 'File extension does not match the file';
			}
		}
		if(!empty($errors)){
			echo display_errors($errors);
			}else{
				//upload file and insert into database
				if(!empty($_FILES)){
					move_uploaded_file($tmpLoc, $uploadPath);
				}
				echo $_POST['title']; 
				$db->query("UPDATE products SET title = '$title' WHERE id = 46 ");
				header("Location:products.php");

			}
		}
?>
<div class="row">
<h2 class="text-center"><?php echo ((isset($_GET['edit']))?'Edit':'Add A new');?> product</h2><hr>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group col-md-3">
		<label for="title">Title*:</label>
		<input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>">
	</div>
	<div class="form-group col-md-3">
		<label for="brand">Brand*:</label>
		<select class="form-control" id="brand" name="brand" >
			<option value=""<?php echo (($brand == '')?'selected':''); ?>></option>
			<?php while($b = mysqli_fetch_assoc($brandQuery)): ?>
				<option value="<?php echo $b['id']; ?>" <?php echo (($brand == $b['id'])?'selected':'');  ?>><?php echo $b['brand']; ?></option>
			<?php endwhile;?>	
		</select>
	</div>
	<div class="form-group col-md-3">
		<label for="parent">parent category*: </label>
		<select class="form-control" id="parent" name="parent">
			<option value="<?php echo (($parent == $p['id'])?'selected':''); ?>"></option>
			<?php while($p = mysqli_fetch_assoc($parentQuery)): ;?>
				<option value="<?php echo $p['id'];?>"<?php echo (($parent == $p['id'])?'selected':'');?>><?php echo $p['category']; ?></option>
		<?php endwhile; ?>
		</select>
	</div>
	<div class=" form-group col-md-3">
	<label for="child">child Category*:</label>
	<select id="child" name="child" class="form-control"></select>
	</div>
	<div class="form-group col-md-3">
	<label for="child">price*:</label>
	<input type="text" id="price" name="price" class="form-control" value="<?php echo $price;?>">
	</div>
	<div class="form-group col-md-3">
	<label for="child">List price:</label>
	<input type="text" id="list_price" name="list_price" class="form-control" value="<?php echo $list_price;?>">
	</div>
	<div class="form-group col-md-3">
	<label>quantity and sizes*:</label>
	<button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">	quantity and sizes</button>	
	</div>
	<div class="form-group col-md-3">
	<label for="sizes">Sizes and Qty preview*:</label>
	<input type="text" class="form-control" name="sizes" id="sizes" value="<?php echo $sizes;?>" readonly>
	</div>
	<div class="form-group col-md-6">
	<?php if ($saved_image != ''): ?>
		<div class="saved-image">
		<img src="<?php echo $saved_image;?>" alt="saved image"/><br>
		<a href="Products.php?delete_image=1&edit=<?php echo $edit_id;?>"class="text-danger">Delete image</a>
		</div>
	<?php else: ?>
		<label for="photo">Product Photo:</label>
		<input type="file" name="photo" id="photo" class="form-control">
	<?php endif; ?>	
	</div>
	<div class="form-group col-md-6">
		<label for="description">Description*:</label>
		<textarea id="description" name="description" class="form-control" rows="6"><?php echo $description; ?></textarea>
	</div>
	<div class="form-group pull-right" >
	<a href="products.php" class="btn btn-default">Cancel</a></div>
	<input type="submit" name="<?php echo ((isset($_GET['edit']))?'Edit':'Add');?>" value="<?php echo ((isset($_GET['edit']))?'Edit':'Add');?> Product" class="btn btn-success">

	
	<!-- <button type="submit" name="Edit">Edit</button> -->

</form>

<!-- //////////////////////////////////modal here==============================start=========================================/////////-->
<div class="modal fade " id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close"  aria-label="close" data-dismiss="modal"><span aria-hiidden="true">&times;</span></button>
				<h4 class="modal-title" id="sizesModalLabel">size & quantity</h4>
			</div>
				<div class="modal-body">
				<div class="container-fluid">
					<?php for($i=1;$i <=12;$i++): ?>
						<div class="form-group col-md-4">
							<label for="size<?php echo $i;?>"> size:</label>
							<input type="text" name="size<?php echo $i;?>" value="<?php echo((!empty($sArray[$i-1]))?$sArray[$i-1]:'')?>" id="size<?php echo $i;?>" class="form-control">
						</div>
						<div class="form-group col-md-2">
						<label for="qty<?php echo $i;?>">Quantity</label>
						<input type="number" name="qty<?php echo $i;?>" value="<?php echo ((!empty($qArray[$i-1]))?$qArray[$i-1]:'')?>" id="qty<?php echo $i;?>" min="0" class="form-control">	
						</div>

					<?php endfor; ?>
				</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">close</button>
					<button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle'); return false;"> save changes</button>
				</div>
		</div>
		
	</div>
</div>
<!-- /////////////////////////////////////////////////////////// modal end here////////////////////////////////////////////////////// -->

<?Php
}else{
$sql ="SELECT * FROM products WHERE deleted = 0";
$presults = $db->query($sql);
if(isset($_GET['featured'])){
	$id = (int)$_GET['id'];
	$featured = (int)$_GET['featured'];
	$featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');
}
?>
<h2 class="text-center">Products</h2>
<button class=" btn btn-success">Generate A report</button>
<a href="products.php?<?php echo (isset($_GET['edit'])?'edit='.$edit_id : 'add=1');?>" class="btn btn-success pull-right" id="add-product-btn">Add Product</a>

<div class="clearfix">
</div>
<hr>
<table class="table table-bordered table-striped table-condensed">
	<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th></thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($presults)): 
		// $childID = $product['categories'];
		// $catSql = "SELECT * FROM categories WHERE id = '$childID'";
		// $result = $db->query($catSql);
		// $child = mysqli_fetch_assoc($result);
		
		// $parentID = $child['parent'];
		// $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
		// $presults = $db->query($pSql);
		// $parent = mysqli_fetch_assoc($presults);
		// $category = $parent['category'].'~'.$child['category']; 
		?>
		<?php 
		$childID = $product['categories'];
		 $catSql = "SELECT * FROM categories WHERE id = '$childID'";
		 $result = $db->query($catSql);
		 $child = mysqli_fetch_assoc($result);
		
		// $parentID = $child['parent'];
		// $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
		// $presults = $db->query($pSql);
		// $parent = mysqli_fetch_assoc($presults);
		$category = $child['category']; 
		?>
			<tr>
				<td>
					<a href="products.php?edit=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="products.php?delete=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				<td><?php echo $product['title']; ?></td>
				<td><?php echo money($product['price']);?></td>
				<td><?php echo $category; ?></td>
				<td><a href="products.php?featured=<?php echo (($product['featured'] == 0)?'1':'0');?>&id=<?php echo $product['id'];?>" class=" btn btn-xs btn-default "><span class="glyphicon glyphicon-<?php echo (($product['featured'])?'minus':'plus');?>"></span>
				</a>
				&nbsp <?php echo (($product['featured'] == 1)?'Featured Product':''); ?>
				</td>
				<td>0</td>

			</tr>

		<?php endwhile; ?>	
	</tbody>

</table>
</div>
</div>

<?php } include 'includes/footer.php'; ?>
<script>
	jQuery('document').ready(function(){
		get_child_options('<?php echo $category;?>');
		});
</script>