 <?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Project_ecommerce/core/init.php';
unset($_SESSION['SBUser']);
header('Location: login.php');

?>