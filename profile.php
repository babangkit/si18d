<?php include("config.php"); ?>
<?php include("body.php"); ?>
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
            echo '<a class="blog-nav-item active" href="profile.php">Profile</a>';
            echo '<a class="blog-nav-item" href="logout.php" onclick="return confirm(\'Yakin?\')">Logout</a>';
          }else{
            
          }
          ?>
          <?php
          if($_SESSION['user']){
              
          }else{
            echo '<a class="blog-nav-item" href="login.php">Login</a>';
          }
          ?>
        </ul>
        </nav>
      </div>
    </div>


  <div class="container container-body"><br>
  <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Profile</h3>
            </div>
            <div class="panel-body">
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
   </div>
  </div>
    <?php include("footer.php"); ?>