<?php
$price_sort = ((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
?>
<h3 class="text-center">Search By:</h3>
<h4 class="text-center">Price</h4>
<form action="search.php" method="post">
	<input type="radio" name="price_sort" value="low"<?=(($price_sort == 'low')?' checked':'');?>>low to high<br>
	<input type="radio" name="price_sort" value="high"<?=(($price_sort == 'high')?' checked':'');?>>high to low<br>


</form>