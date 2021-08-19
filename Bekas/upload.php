<?php include("config.php"); ?>
<?php include("body.php"); ?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li ><a href="index.php">Home</a></li>
          <li class="active"><a href="upload.php">Upload</a></li>
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
    <h1>Upload</h1>
    <hr>
    <?php
    if(!$_SESSION['user']){
      echo '<div class="alert alert-danger">Anda harus login untuk membuka halaman ini.</div>';
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
          if (!$success) { 
            echo '<div class="alert alert-warning">Gagal upload file.</div>';
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

    <?php
    }
    ?>

<?php include("footer.php"); ?>