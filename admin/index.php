<?php
  require_once '../core/init.php';
  if(!is_logged_in()){
  	header('Location: login.php');
  }
  include 'includes/head.php';
  include 'includes/navigation.php';

$count_log = $db->query("SELECT * FROM transactions_paypal");
$count = mysqli_num_rows($count_log);

$airtel_log = $db->query("SELECT * FROM mobile_money");
$airtel_count = mysqli_num_rows($airtel_log); 

$products_log = $db->query("SELECT * FROM products");
$products_count = mysqli_num_rows($products_log); 

$user_log = $db->query("SELECT * FROM users");
$user_count = mysqli_num_rows($user_log); 

?>
<br><br><br>
<div class="row">
<!-- ==================================================================== -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                                                  
                                    <div class="huge">17</div>
                                    <div><h3>Cash Transactions</h3></div>
                                </div>
                            </div>
                        </div>
                        <a href="cash_table.php">
                            <div class="panel-footer">
                                <span class="pull-left">View cash transactions</span>
                                <span class="pull-right"><i class="glyphicon glyphicon-email"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             <!-- ==================================================================== -->
             <!-- ==================================================================== -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cc-paypal fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class="huge"><span class="w3-badge w3-blue"><?=$count;?></span></div>
                                    <div><h4>Paypal Transaction</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="transactions/paypal.php">
                            <div class="panel-footer">
                                <span class="pull-left">View paypal Transaction</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             <!-- ==================================================================== -->

             <!-- ==================================================================== -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading" >
                        
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                                                  
                                    <div class="huge w3-badge w3-red"><?=$airtel_count;?></div>
                                    <div><h3>Airtel money Transactions</h3></div>
                                </div>
                            </div>
                        </div>
                        <a href="transactions/paypal.php">
                            <div class="panel-footer" >
                                <span class="pull-left"></span>
                                <span class="pull-left">View Airtel Transaction</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             <!-- ==================================================================== -->
          
          </div>

          <!-- ==================================================================== -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading" >
                        
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                                                  
                                    <div class="huge w3-badge w3-red"><?=$user_count;?></div>
                                    <div><h3>users</h3></div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer" >
                                <span class="pull-left"></span>
                                <span class="pull-left">View users signup users</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             <!-- ==================================================================== -->
          
          </div>

           <!-- ==================================================================== -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading" >
                        
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cubes fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                                                  
                                    <div class="huge w3-badge w3-red"><?=$products_count;?></div>
                                    <div><h3>PRODUCTS</h3></div>
                                </div>
                            </div>
                        </div>
                        <a href="products.php">
                            <div class="panel-footer" >
                                <span class="pull-left"></span>
                                <span class="pull-left">See products</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             <!-- ==================================================================== -->
          
          </div>

































<?php include 'includes/footer.php';?>