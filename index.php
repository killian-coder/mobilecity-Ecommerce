<?php 
    require_once 'core/init.php';    
    include 'includes/head.php'; 
    include 'includes/navigation.php';
    include 'includes/headerfull.php';
    include 'includes/leftbar.php';
   
   $sql ="SELECT * FROM products WHERE featured =1";
   $db->query($sql);
   $featured = $db->query($sql);


?> 

        <!-- Main content -->
                           <div class="col-sm-8">
                                    <h2 class="text-center">Feature product</h2>
                                    <?php while($product= mysqli_fetch_assoc($featured)) : ?>
                                        <div class="col-sm-3">
                                            <h4><?php echo $product['title']; ?></h4>
                                                <img src="<?php echo $product['image'];?>" id="img-size" alt="<?=$product['title'];?>" class="details img-responsive">
                                                <p class="list-price text-danger">list price <s><?php echo $product['list_price']; ?></s></p>
                                                <p>our price:$ <?php echo $product['price']; ?></p>
                                                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodel(<?php echo $product['id']; ?>)">Details</button>
                                                <!-- <a type="button" href="cash_purchase.php" class="btn btn-sm btn-primary">buy Now</a> -->
                                        </div>
                                <?php endwhile; ?>
                            </div>                                           
                       
<?php
 include 'includes/rightbar.php';
 include 'includes/footer.php';

 
?>
    