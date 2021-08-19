<?php include("config.php"); ?>
<?php include("body.php"); ?>
<a class="blog-nav-item active" href="index.php">Home</a>
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
            echo '<a class="blog-nav-item" href="login.php">Login</a>';
          }
          ?>
        </ul>
        </nav>
      </div>
    </div>


  <div class="container container-body">
    <h1>Selamat datang!</h1>
    <br>
    <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Informasi</h3>
            </div>
            <div class="panel-body">
            <p><b>Harap Di Perhatikan:</b></p>
    <?php
    if(!$_SESSION['user']){
      echo '<br><p>Untuk upload tugas silahkan login terlebih dahulu.</p>
    Untuk Login :
    <a class="btn btn-primary" href="login.php" role="button">Klik Disini</a>';
    }else{ ?>
            <?php
        $sql1 = $conn->query("SELECT * FROM info");
        if($sql1->num_rows > 0){
          $row = $sql1->fetch_assoc();
          $info1 = $row['info1'];
          $info2 = $row['info2'];
        }
    ?>

    <ol>
      <li><?=  $info1;?></li>
      <li><?=  $info2;?></li>
      <li>Untuk Upload silahkan klik menu <b>Upload</b> di atas, atau <a class="btn btn-primary btn-sm" href="upload.php" role="button">Klik Disini</a></li>
      <li>Jika sukses Upload silahkan cek file yang sudah di upload di menu <b>Download</b> atau  <a class="btn btn-success btn-sm" href="download.php" role="button">Klik Disini</a></li>
    </ol><hr>
    <p><b>Catatan:</b> Jangan Upload file terlalu besar, Max 2MB, jika lebih dari itu akan Gagal Upload</p>

            </div>
          </div>
   <?php } ?>
<?php include("footer.php"); ?>