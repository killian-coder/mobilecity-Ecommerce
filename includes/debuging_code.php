   
footer code
    <script>
        jQuery(window).scroll(function(){
            var vscroll = jQuery(this).scrollTop();
            jQuery('#logotext').css({
                "transform" : "translate(0px, "+vscroll/2+"px)"
            });
        });
    </script>

<?php 

    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
	$cart = mysqli_fetch_assoc($cartQ);
	$previous_items = json_decode($cart['items'],true);
	$item_match = 0;
	$new_items = array();
	foreach($previous_items as $pitem){
		if($item[0]['id'] == $pitem['id'] && $item['size'] == $pitem['size']){
			$pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
			if($pitem['quantity'] > $available){
				$pitem['quantity'] = $available;
			}
			$item_match = 1;
		}
		$new_items[] = $pitem;
	}
	if($item_match != 1){
		$new_items = array_merge($item,$previous_items);
	}
	$items_json = json_encode($new_items);
	$cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
	$db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
	setcookie(CART_COOKIE,'',1,'/',$domain,false);
	setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
	?>


	$product_id = (isset($_POST['product_id']));
$size =  (isset($_POST['size']));
$available =  (isset($_POST['available']));
$quantity = (isset($_POST['quantity']));



require_once $_SERVER['DOCUMENT_ROOT'].'/mobilecity-Ecommerce/core/init.php';
$name = sanitize($_POST['name']);
$email = sanitize($_POST['email']);
$street = sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$city = sanitize($_POST['city']);
$province = sanitize($_POST['province']);
$zip_code = sanitize($_POST['zip_code']);
$country = sanitize($_POST['country']);
$errors = array();
$required =array(
'full_name'   => 'Full Name';
'email'       => 'Email',
'street'      => 'street Address',
'city'        => 'City',
'province'    => 'Province',
'zipcode'     => 'Zip code',
'country'     => 'country',
);

//check if all field are 
foreach ($required as $f => $d) {
	if(empty($_POST['$f']) || $_POST[$f] == ''){
		$errors[] = $d. ' is required. ';
	}
}

if(!empty($errors)){
	echo  display_errors($errors);
}else{
	echo 'passed ';
}

?>


<div class="col-xs-2">
        <label for="ex1">col-xs-2</label>
        <input class="form-control" id="ex1" type="text">
      </div>