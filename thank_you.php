<?php
require_once 'core/init.php';
include 'includes/head.php';
// include 'includes/navigation.php';

  $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
  $result = mysqli_fetch_assoc($cartQ);
  $items = json_decode($result['items'],true);

?>

            <br><br>

<h3 class="text-center" style="font-family:Courier; color:#0000e6; font-size: 35px" >Use any of the Services to complete your purchase</h3><br><br>

<div class="col-md-4">
                  <div class="panel panel-default">
                  <div class="panel-heading" style="background-color:#339cff;"> <a href="https://www.sandbox.paypal.com/cgi-bin/webscr"><strong>Paypal</strong></a></div>
                   <div class="panel-body">
              <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="mobilecity@gmail.com">
              <?php
                foreach($items as $item){
                  $product_id = $item['id'];
                  $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                  $product = $product = mysqli_fetch_assoc($productQ);
                  $sArray = explode(',',$product['sizes']);
                  foreach($sArray as $sizeString){
                    $s = explode(':',$sizeString);
                    if($s[0] == $item['size']){
                      $available = $s[1];
                    }
                  }
                  $tax = 0.5;

                   echo $product_id;
                  ?> 
              <input type="hidden" name="item_name" value="<?=$product['title'];?>"
              <input type="hidden" name="amount" value="<?=$product['price'];?>">
              <input type="hidden" name="quantity" value="<?=$item['quantity'];?>">
                <input type="hidden" name="tax" value="<?=$tax;
              }
                ?>">
              <input type="image" name="submit"
                src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png"
                alt="PayPal- checkout">
            </form>
          </div>
          <div class="panel-footer" style="background-color:#339cff;"></div>
          </div>  
              </div>
              <div class="col-md-4" >
                <div class="panel panel-default" href="airtel_form.php">
                  <div class="panel-heading" style="background-color:#339cff;"><a href="airtel_form.php"><strong>Airtel money</strong></a></div>
                  <div class="panel-body">
                     <a href="airtel_form.php"><img src="image/shoop/Airtel-Money.jpg" alt="Airtel-Money" height="60px" width="100%"></a>
                  </div>
                  <div class="panel-footer" style="background-color:#339cff;"></div>
                
                  </div>

              </div>
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading" style="background-color:#339cff;"><a href="cash_purchase.php"><strong> Cash on delivery</strong></a></div>
                  <div class="panel-body">
                    <a href="cash_purchase.php"><img src="image/shoop/cod_logo.png" alt="Cash on delivery" height="60px" width="auto"></a>
                  </div>
                  <div class="panel-footer" style="background-color:#339cff;"></div>
                
                  </div>
              </div>
<?php if(isset($_POST['submit'])){
  $item_name =$_POST['item_name'];
  $quantity =$_POST['quantity'];
  $tax      =$_POST['tax'];
  $paid     = 1;

  $insert = "INSERT INTO `transactions_paypal` (`id`, `cart_id`, `tax`, `quantity`, `paid`) VALUES (NULL, '$cart_id', '$tax', '$quantity', '$paid');";
 $result = $db->query($insertsql);
 $result = $db->query($insertsql);
if($result){
  echo "from succefully submitted";
}else{
  echo "your form did not submit plz chech that you have an internet conection";
} 

}


?>
</body
</html>
 </div><br><br>
<div class="col-md-12 text-center">&copyright 2014-2017 mobile city zambia</div>