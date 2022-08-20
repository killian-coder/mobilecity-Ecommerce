<?php
  require_once '../core/init.php';
  
  if(!is_logged_in()){
  	login_error_redirect();
  }

  if(!has_permission('admin')){
  	permission_error_redirect('index.php');	
  	}
  include 'includes/head.php';
  include 'includes/navigation.php';
  
  if(isset($_GET['delete'])){
    $delete_id = sanitize($_GET['delete']);
    $db->query("DELETE FROM users WHERE id ='$delete_id'");
    $_SESSISON['success_flash'] = 'user has been deleted.';
    header('Location: users.php');
  }
  if(isset($_GET['add'])){
    $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $permission = ((isset($_POST['permission']))?sanitize($_POST['permission']):'');
    $errors = array();
    if($_POST){
      $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
      $emailCount = mysqli_num_rows($emailQuery);


      if($emailCount != 0){
        $errors[] ='There is a user who already exist with that email. '; 
      }
      $required = array('name','email','password','confirm','permission');
      foreach($required as $f){
        if(empty($_POST[$f])){
          $errors[] = 'you must fill all the field.';
          break;
        }
      }
      //paasword less than 6
      if(strlen($password) < 6){
        $errors[] = 'your password must be atleast 6 characters or more.';
      }

      if($password != $confirm){
        $errors[] = 'You password does not match.';
      }
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] ='You must enter a valid Email.';
      }
      if(!empty($errors)){
        echo display_errors($errors); 
      }else{
        //add user to database
        $hashed = password_hash($password,PASSWORD_DEFAULT);
        $db->query("INSERT INTO users (full_name,email,password,permission) values('$name','$email','$hashed','$permission')");
        $_SESSISON['success_flash'] = 'user has been added.';
        header('Location: users.php');
      }
    }
    ?>
    <br>
    <h2 class="text-center">Add a New User</h2><hr>
    <form action="users.php?add=1" method="post">
      <div class="form-group col-md-6">
        <label for="name">Full name:</label>
        <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
      </div>
      
      <div class="form-group col-md-6">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
      </div>
      
      <div class="form-group col-md-6">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" class="form-control" value="<?=$password;?>">
      </div>
      
      <div class="form-group col-md-6">
        <label for="confirm">Confirm password.</label>
        <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
      </div>
      
      <div class="form-group col-md-6">
        <label for="permission">Permissions.</label> 
        <select class="form-control" name="permission">
          <option value="" <?=(($permission == '')?' selected':'');?>></option>
           <option value="editor"<?=(($permission == 'editor')?' selected':'');?>>Editor</option>
            <option value="admin,editor" <?=(($permission == 'admin,editor')?' selected':'');?>>Admin</option>
        </select>
      </div>
      
      <div class="form-group col-md-6 text-right" style="margin-top:25px;">
        <a href="users.php" class="btn btn-default">cancel</a>
        <input type="submit" value="Add User" class="btn btn-primary">
      </div>
    </form>
 
 <?php
  }else{    
  $userQuery = $db->query("SELECT * FROM users ORDER BY full_name ");
?>

<h2 class="text-center">Users Table</h2><br><br>


<a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add New user</a>
<a href="transactions/users.php" class="btn btn-success inline">Generate print copy <span class="glyphicon glyphicon-fax"></span> </a>

<hr>
<table class="table table-bordered table-striped table-condensed">
<thead><th></th> <th>Name</th> <th>Email</th><th>Join Date</th><th>Last login</th><th>Permissions</th></thead>
<tbody>
  <?php while($user = mysqli_fetch_assoc($userQuery)): ?>
  <tr>
    <td>
      <?php if($user['id'] != $user_data['id']):?>
        <a href="users.php?delete=<?=$user['id']?>" class="btn btn-default btn-xs"> <span class="glyphicon glyphicon-remove-sign"></span></a>

      <?php endif;?>
    </td>
    <td><?=$user['full_name'];?></td>
    <td><?=$user['email'];?></td>
    <td><?=pretty_date($user['join_date']); ?></td>
    <td><?=(($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login'])); ?></td>
    <td><?=$user['permission'];?></td>
  </tr>
   <?php endwhile; ?>
</tbody>
</table>

<?php } include 'includes/footer.php';?>