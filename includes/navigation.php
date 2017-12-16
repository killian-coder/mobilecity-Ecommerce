<?php
$sql = " SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>
<!-- top logo -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            <a href="#"><img src="image/moblogo.png" height="150" width="120"></a>   
            </div>
            <div class="col-md-6" pull-rigth><img src="image/header123.png" alt="header123.png"></div>
            <div class="col-md-4">
            <div class="form-group">
                
                <label><i class="fa fa-search"></i>:</label>
                <input type="search" name="search">
            </div><br><br>
            <ul id="social-links">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                   <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                   <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                   <li><a href="#"><i class="fa fa-github"></i></a></li>
                  <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            </ul>
            
            </div>
        </div>
    </div>
</header>
<br>
 <!-- top nav header -->
    <nav class="navbar navbar-default blue-color" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>

              <?php while($parent = mysqli_fetch_assoc($pquery)): ?>
                <?php $parent_id = $parent['id']; 
                $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                $cquery = $db->query($sql2);
                ?>
                <!-- menu Items -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category'];?><b class="caret"></b></a> 
                        <ul class="dropdown-menu">
                            <?php while($child = mysqli_fetch_assoc($cquery)) :?>
                            <li>
                             <a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category']; ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    </li>
                </ul>
                <?php endwhile; ?>

                <ul class="nav navbar-nav pull-left">
                    <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"> MyCart</span></a></li></ul>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>