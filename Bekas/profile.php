<?php include("config.php"); ?>
<?php include("body.php"); ?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="upload.php">Upload</a></li>
          <li><a href="download.php">Download</a></li>
          <?php
           $user="kiki";
           if($_SESSION['user'] == $user){
            echo '<li> <a href="admin.php">Admin</a></li>';
          }else{
            echo '<li> <a href="about.php">About Author</a></li>';
          }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          if($_SESSION['user']){
            echo '<li class="active"><a href="profile.php">Profile</a></li>';
            echo '<li><a href="logout.php" onclick="return confirm(\'Yakin?\')">Logout</a></li>';
          }else{
            echo '<li><a href="login.php">Login</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container container-body">
    <h1>Profile</h1>
    <hr>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <?php
        $sql = $conn->query("SELECT * FROM user WHERE username='{$_SESSION['user']}'");
        $data = $sql->fetch_assoc();
        ?>
        <table class="table">
          <tr>
            <th>USERNAME</th><th>:</th><td><?php echo $data['username']; ?></td>
          </tr>
          <tr>
            <th>TGL. DAFTAR</th><th>:</th><td><?php echo $data['tgl_daftar']; ?></td>
          </tr>
          <tr>
            <th>NAMA LENGKAP</th><th>:</th><td><?php echo $data['nama']; ?></td>
          </tr>
          <tr>
            <th>EMAIL</th><th>:</th><td><?php echo $data['email']; ?></td>
          </tr>      
        </table>
      </div>
    </div>
    <?php include("footer.php"); ?>