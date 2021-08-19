<?php include("config.php"); ?>
<?php include("body.php"); ?>
<a class="blog-nav-item" href="index.php">Home</a>
          <a class="blog-nav-item active" href="upload.php">Upload</a>
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


  <div class="container container-body"><br>
  <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Form Upload</h3>
            </div>
            <div class="panel-body">
    <?php
    if(!$_SESSION['user']){
      echo '<div class="alert alert-danger">Anda harus login untuk membuka halaman ini.</div>';
    }else{

      $sql5 = $conn->query("SELECT * FROM aktifasi");
      if($sql5->num_rows > 0){
        $row = $sql5->fetch_assoc(); 
        $iid  = $row['id'];
        $aktiff = $row['isi'];
      }

      if($aktiff !== $iid){
        echo '<div class="alert alert-danger">Maaf Halaman Upload Tidak Tersedia, Tidak ada jadwal Upload Tugas.</div>';
      }else{

    ?>
    <?php
        $sql1 = $conn->query("SELECT * FROM info");
        if($sql1->num_rows > 0){
          $row = $sql1->fetch_assoc();
          $info1 = $row['info1'];
          $info2 = $row['info2'];
        }
    ?>
    
        <?php
    //MATKUL
        $sql1 = $conn->query("SELECT * FROM info_2 WHERE id=1");
        if($sql1->num_rows > 0){
          $row = $sql1->fetch_assoc();
          $no_m = $row['id_matkul'];
        }

        $sql2 = $conn->query("SELECT * FROM matkul WHERE id='$no_m'");
        if($sql2->num_rows > 0){
          $row = $sql2->fetch_assoc();
          $info_matkul = $row['nama'];
        }
    ?>
    <?php
    //HARI & JAM
        $sql1 = $conn->query("SELECT * FROM id_hari WHERE id=1");
        if($sql1->num_rows > 0){
          $row = $sql1->fetch_assoc();
          $no_h = $row['id_hari'];
        }

        $sql2 = $conn->query("SELECT * FROM hari WHERE id='$no_h'");
        if($sql2->num_rows > 0){
          $row = $sql2->fetch_assoc();
          $info_hari = $row['nama'];
        }
        $sql3 = $conn->query("SELECT * FROM hari WHERE id=10");
        if($sql3->num_rows > 0){
          $row = $sql3->fetch_assoc();
          $jam = $row['nama'];
        }
    ?>


    <center><div class="alert alert-info" role="alert">Tugas yang di kumpukan adalah <b><?=  $info_matkul;?></b>. Maximal di kumpulkan Hari <b><?=  $info_hari;?>, Jam <?=  $jam;?> WIB</b></div></center>
   
    <p><?=  $info1;?></p>
    <p><?=  $info2;?></p>

    <hr>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-10">
              <input type="file" name="myFile" class="filestyle" data-icon="false"> <br>
              <input type="submit" name="upload" class="btn btn-primary" value="Upload">
            </div>
             
            
          </div>
        </form>

        <?php
        $sql = $conn->query("SELECT alamat FROM url");
        if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();
        $url = $row['alamat'];
        }
        // definisi folder upload
        define("UPLOAD_DIR", "File/".$url);

        if (!empty($_FILES["myFile"])) {
          $myFile = $_FILES["myFile"];
          $ext    = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);
          $size   = $_FILES["myFile"]["size"];
          $tgl   = date("Y-m-d");
          $exten = array('docx','doc','php','rar');

          if ($myFile["error"] !== UPLOAD_ERR_OK) {
            echo '<div class="alert alert-warning">Upload file gagal.</div>';
            exit;
          }else if(in_array($ext, $exten) === false){
            echo '<div class="alert alert-danger">Upload gagal, format harus <b>.docx, .doc, .php, atau .rar </b>.</div>';
            exit;
          }else if($size > 2000000){
            echo '<div class="alert alert-danger">Upload gagal, <b>size</b> terlalu besar. Max 2MB</div>';
            exit; 
          }else if($myFile["name"] == 'index.php'){
            echo '<div class="alert alert-danger">Upload gagal, ganti nama PHP, jangan gunakan <b>index.php</b></div>';
            exit; 
          }

          // filename yang aman
          $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

          // mencegah overwrite filename
          $i = 0;
          $parts = pathinfo($name);
          while (file_exists(UPLOAD_DIR . $name)) {
            $i++;
            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
          }

          // upload file
          $success = move_uploaded_file($myFile["tmp_name"],
            UPLOAD_DIR . $name);
          if (!$url) { 
            echo '<div class="alert alert-warning">Gagal upload file.</div>';
            exit;
          }else if (!$success) { 
            echo '<div class="alert alert-danger">Maaf waktu upload telah berakhir.</div>';
            exit;
          }else{

            $insert = $conn->query("INSERT INTO uploads(tgl_upload, file_name, file_size, file_type) VALUES('$tgl', '$name', '$size', '$ext')");
            if($insert){
              echo '<div class="alert alert-success">File '.$name.' berhasil di upload. <br><a class="btn btn-success btn-sm" href="download.php" role="button">Klik Disini</a> untuk mengecek filemu</div>';
            }else{
              echo '<div class="alert alert-warning">Gagal upload file.</div>';
              exit;
            }
          }

          // set permisi file
          chmod(UPLOAD_DIR . $name, 0644);
        }
        ?>

      </div>
    </div>
    </div>
  </div>
    <?php
    }
    }
    ?>

<?php include("footer.php"); ?>