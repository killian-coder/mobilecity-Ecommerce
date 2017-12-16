<?php
$sql = " SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>
<nav class="navbar navbar-default" style="background-color:#0099cc;" role="navigation">
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