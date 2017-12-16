<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Project_ecommerce/core/init.php';
if(!is_logged_in()){
  	login_error_redirect();
  }
include 'includes/head.php';
include 'includes/navigation.php';
$sql = "SELECT * FROM categories WHERE parent = 0";
$result = $db->query($sql);
$errors = array();
$category ='';
$post_parent ='';

//edit category
if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$edit_id =(int) $_GET['edit'];
	$edit_id = sanitize($edit_id);
	$editsql = "SELECT * FROM categories WHERE id ='$edit_id'";
	$edit_result = $db->query($editsql);
	$edit_category = mysqli_fetch_assoc($edit_result);
}

// Delete Category
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql = "SELECT * FROM categories WHERE id = '$delete_id'";
	$result = $db->query($sql);
	$category = mysqli_fetch_assoc($result);
	if($category['parent'] == 0){
		$sql = "DELETE FROM Categories WHERE parent = '$delete_id'";
		$db->query($sql);

	}
	$dsql = "DELETE FROM categories WHERE id ='$delete_id'";
	$db->query($dsql);
	header('Location: categories.php');
}

// proccess form
if (isset($_POST) && !empty($_POST)) {
	$post_parent = sanitize($_POST['parent']);
	$category = sanitize($_POST['category']);
	$sqlfform = "SELECT * FROM categories WHERE category = '$category' AND parent='$post_parent'";
	if(isset($_GET['edit'])){
		$id = $edit_category['id'];
		$sqlfform ="SELECT * FROM categories WHERE category = '$category' AND Parent ='$post_parent' AND id != '$id'";
	}
	$fresult = $db->query($sqlfform);
	$count = mysqli_num_rows($fresult);
	// check if category is blank
	if ($category == '') {
		$errors[] .='The category cannot be left Blank.';
	}

// if exist in the database
	if($count> 0){
		$errors[] = $category. ' already exist please choose a new category.';
	}

//display  another Error or update database

	if(!empty($errors)){
		//display Erros
		$display = display_errors($errors); 

?>

	<script>
		jQuery('document').ready(function(){
			jQuery('#errors').html('<?php echo $display; ?>');
		});
	</script>
<?php }else{
// update database
	$updatesql = "INSERT INTO categories (category,parent) VALUES ('$category','$post_parent')";
	if(isset($_GET['edit'])){
		$updatesql ="UPDATE categories SET category= '$category', parent ='$parent_value' WHERE id = '$edit_id' ";
	}
	$db->query($updatesql);
	header('Location: categories.php');

	} 

}
$category_value = '';
$parent_value ='0';
if(isset($_GET['edit'])){
	$category_value = $edit_category['category'];
	$parent_value = $edit_category['parent'];
}else{
	if(isset($_POST)){
		$category_value = $category; 
		$parent_value = $post_parent;
	}
}
?>
<h2 class="text-center">Categories</h2><hr>
<div class="row">


<!-- Form -->
<div class="col-md-6">
<form class="form" action="categories.php<?php echo((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
<legend><?php echo ((isset($_GET['edit']))?'Edit':'Add A');?> Category</legend>
<div id="errors"></div>
	<div class="form-group">
		<label for="parent">Parent</label>
		<select class="form-control" name="parent" id="parent">
			<option value="0"<?php echo (($parent_value == 0)?' selected="selected"':''); ?>>parent</option>
			<?php while($parent=mysqli_fetch_assoc($result)): ?>
				<option value="<?php echo $parent['id']; ?>" <?php echo (($parent_value == $parent['id'])?' selected="selected"':''); ?>><?php echo $parent['category']; ?></option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="category">Category</label>
		<input type="text" name="category" class="form-control" id="category" value="<?php echo $category_value; ?>">
	</div>
	<div class="form-group">
		<input type="submit" value="<?php echo ((isset($_GET['edit'])))?'Edit':'Add'; ?> category" class="btn btn-success">
	</div>
</form>
</div>


<!-- Category Table-->
<div class="col-md-6">
	<table class="table table-boardered">
		<thead>
			<th>Category</th><th>Parent</th><th></th>
		</thead>
		<tbody>
		<?php 
		$sql = "SELECT * FROM categories WHERE parent = 0";
		$result = $db->query($sql);
		while($parent = mysqli_fetch_assoc($result)): 
		$parent_id = (int)$parent['id'];
			$sql2 ="SELECT * FROM categories WHERE parent ='$parent_id'";
			$cresult = $db->query($sql2);
		?>
			<tr class="bg-primary">
				<td><?php echo $parent['category']; ?></td>
				<td>parent</td>
				<td>
					<a href="Categories.php?edit=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="Categories.php?delete=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				
			</tr>
				<?php while($child= mysqli_fetch_assoc($cresult)): ?>
				<tr class="bg-infor">
				<td><?php echo $child['category']; ?></td>
				<td><?php echo $parent['category'];  ?></td>
				<td>
					<a href="Categories.php?edit=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="Categories.php?delete=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				
			</tr>	
			<?php endwhile; ?>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>
</div>
<?php include 'includes/footer.php'; ?>