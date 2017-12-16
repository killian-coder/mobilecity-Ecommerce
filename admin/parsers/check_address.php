<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Project_ecommerce/core/init.php';
$name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$street = sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$city = sanitize($_POST['city']);
$province = sanitize($_POST['province']);
$zip_code = sanitize($_POST['zipcode']);
$country = sanitize($_POST['country']);
$errors = array();
$required =array(
'full_name'   => 'Full Name',
'email'       => 'Email',
'street'      => 'Street Address',
'city'        => 'City',
'province'    => 'Province',
'zipcode'     => 'Zip code',
'country'     => 'Country',
);

//check if all field are field out
foreach ($required as $f => $d) {
	if(empty($_POST[$f]) || $_POST[$f] == ''){
		$errors[] = $d. ' is required. ';
	}
}

//check if valid email address
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	$errors[] = 'Please enter a valid email.';
}

if(!empty($errors)){
	echo display_errors($errors);
}else{
	echo 'passed';
}

?>