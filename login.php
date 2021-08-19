<?php include("config.php"); ?>
<?php include("body.php"); ?>
 <?php
 if($_SESSION['user']){
     header("Location: index.php");
 }else{
?>
<a class="blog-nav-item" href="index.php">Home</a>
          <a class="blog-nav-item" href="upload.php">Upload</a>
          <a class="blog-nav-item" href="download.php">Download</a>
           <?php
           $user="kiki";
           if($_SESSION['user'] == $user){
            echo '<a class="blog-nav-item" href="admin.php">Admin</a>';
            echo '<a class="blog-nav-item" href="logout.php" onclick="return confirm(\'Yakin?\')">Logout</a>';
          }else{
            
          }
          ?>
          <?php
          $user1="admin";
          if($_SESSION['user'] == $user1){
            echo '<a class="blog-nav-item" href="profile.php">Profile</a>';
            echo '<a class="blog-nav-item" href="logout.php" onclick="return confirm(\'Yakin?\')">Logout</a>';
          }else{
            
          }
          ?>
          <?php
          if($_SESSION['user']){
              
          }else{
            echo '<a class="blog-nav-item active" href="login.php">Login</a>';
          }
          ?>
        </ul>
        </nav>
      </div>
    </div>


  <div class="container container-body"><br>
    <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Login</h3>
            </div>
            <div class="panel-body">
            <br>
    <div class="row">
      <div class="col-md-4 col-md-offset-2">

        <?php
        if($_POST['login']){
          $user   = 'admin';
          $pass   = md5($conn->real_escape_string($_POST['password']));

          $sql = $conn->query("SELECT * FROM user WHERE username='$user' AND password='$pass'");
          if($sql->num_rows > 0){
            $_SESSION['user'] = $user;
            header("Location: index.php");
          }else{
            echo '<div class="alert alert-danger">Login gagal.</div>';
          }
        }
        ?>

        <form class="form-horizontal" method="post">
          <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-8">
              <input type="password" name="password" class="form-control" placeholder="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">&nbsp;</label>
            <div class="col-md-8">
              <input type="submit" name="login" class="btn btn-primary" value="Login">
            </div>
          </div>
 
        </form>
      </div>
    </div>
   </div>
  </div>
     <?php } ?>
    <?php include("footer.php"); ?>