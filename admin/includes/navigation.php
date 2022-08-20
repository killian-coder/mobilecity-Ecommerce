<!-- top nav header -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <a href="/mobilecity-Ecommerce/admin/index.php" class="navbar-brand">Mobile City Admin</a>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- menu Items -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar ">
                <li><a href="brands.php">Brands</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="archieved.php">Archived</a></li>
                <li><a href="reports.php">Report</a></li>

                <?php if (has_permission('admin')) : ?>
                    <li><a href="users.php">Users</a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?= $user_data['first']; ?>!
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="change_password.php">Change password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>




                <!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?> 
                        <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        
                            <li><a href="#"></a></li>
                        </ul>

                        
                    </li> -->
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
<br><br>