<?php include("config.php"); ?>
<?php include("body.php"); ?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
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
            echo '<li><a href="profile.php">Profile</a></li>';
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
    <h1>Selamat datang!</h1>
    <?php
    if(!$_SESSION['user']){
      echo '<hr><p>Untuk upload tugas silahkan login terlebih dahulu.</p>
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
    <hr>
    <p><b>Harap Di Perhatikan:</b></p>
    <ol>
      <li><?=  $info1;?></li>
      <li><?=  $info2;?></li>
      <li>Untuk Upload silahkan klik menu <b>Upload</b> di atas, atau <a class="btn btn-primary btn-sm" href="upload.php" role="button">Klik Disini</a></li>
      <li>Jika sukses Upload silahkan cek file yang sudah di upload di menu <b>Download</b> atau  <a class="btn btn-success btn-sm" href="download.php" role="button">Klik Disini</a></li>
    </ol><br>
    <p><b>Catatan:</b> Jangan Upload file terlalu besar, Max 2MB, jika lebih dari itu akan Gagal Upload</p>
<?php } ?>
<?php include("footer.php"); ?>