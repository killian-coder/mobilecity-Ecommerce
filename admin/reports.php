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
                                    <div><h3>Cash Transactions Reports</h3>
                                        <ul>
                                            <li><a href="transactions/cash_transaction.php" class="text-center">Overall reports</a></li>
                                            <li><a class="text-center" href="transactions/monthly_report.php">monthy reports</a></li>
                                        </ul>

                                        


                                    </div>


                                </div>
                            </div>
                        </div>
                        <a href="cash_table.php">
                            <div class="panel-footer">
                                <span class="pull-left">View cash transactions Reports</span>
                                <span class="pull-right"><i class="glyphicon glyphicon-email"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

<?php include 'includes/footer.php';?>