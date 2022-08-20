<?php
require_once 'core/init.php';

if(isset($_POST['submit']))
{
  $firstname = $_POST['firstname'];
  $last_name = $_POST['last_name'];
  $nrc_number = $_POST['nrc_number'];
  $gender = $_POST['gender'];
  $phone_number = $_POST['phone_number'];
  $current_address = $_POST['current_address'];
  $address = $_POST['address'];
  $order_status = $_POST['order_status'];

$insertsql = "INSERT INTO `cash_on_delivery` (`id`, `firstname`, `last_name`, `nrc_number`, `phone_number`, `current_address`, `address`, `order_status`) VALUES (NULL, '$firstname', '$last_name', ' $nrc_number', '$phone_number', ' $address', '$address', '$order_status')";
$result = $db->query($insertsql);
if($result){
  echo "Data insert";
}else{
  echo "data not insert";
} 


}

?>








<!DOCTYPE html>
<html>
<head>
  <title>insert stuff into the database</title>
</head>
<body>
  <?php  $order_status = 0; ?>


<form class="form" role="form" action="" method="post">
  <label>First name:</label> <br>
  <input type="text" name="firstname" id="firstname" ><br>

  <label>Last name:</label> <br>
  <input type="text" name="last_name" id="last_name" ><br>

  <label>NRC:*</label> <br>
  <input type="text" name="nrc_number" id="nrc_number"><br>
  Gender:
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="female") echo "checked";?>
value="female" id="female" >Female
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="male") echo "checked";?>
value="male" id="male" >Male

  <label>Address:</label> <br>
  <input type="text" name="address" id="Address"><br>

  <label>Current Address:*</label> <br>
  <input type="text" name="current_address" id="current_address"><br>

  <label>phone number:*</label> <br>
  <input type="text" name="phone_number" id="phone_number"><br>
  <input type="hidden" name="<?=$order_status;?>" id="order_status"><br>
  
<button type="submit" class="btn btn-primary" name="submit"><span class="fa fa-send">submit</span></button>

</form>

</body>
</html>
