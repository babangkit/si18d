<?php include("config.php"); ?>
<?php include("body.php"); ?>


  <div class="container container-body">
    <h1>Register</h1>
    <hr>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">

        <?php
        if($_POST['register']){
          $nama   = $conn->real_escape_string($_POST['nama']);
          $email  = $conn->real_escape_string($_POST['email']);
          $user   = $conn->real_escape_string($_POST['username']);
          $pass   = $conn->real_escape_string($_POST['password']);
          $pass2  = $conn->real_escape_string($_POST['password2']);
          $tgl    = date("Y-m-d");
          if(strlen($pass) >= 5){
            if($pass == $pass2){
              $password = md5($pass);
              $insert = $conn->query("INSERT INTO user(tgl_daftar, nama, email, username, password) VALUES('$tgl', '$nama', '$email', '$user', '$password')");
              if($insert){
                echo '<div class="alert alert-success">Register berhasil, silahkan <a href="login.php">Login</a>.</div>';
              }else{
                echo '<div class="alert alert-danger">Gagal melakukan Register.</div>';
              }
            }else{
              echo '<div class="alert alert-danger">Konfirmasi password tidak sesuai.</div>';
            }
          }else{
            echo '<div class="alert alert-danger">Password minimal 5 karakter.</div>';
          }
        }
        ?>
        <form class="form-horizontal" method="post">
          <div class="form-group">
            <label class="col-md-4 control-label">Nama Lengkap</label>
            <div class="col-md-8">
              <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="required">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-8">
              <input type="email" name="email" class="form-control" placeholder="email@domain.com" required="required">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Username</label>
            <div class="col-md-8">
              <input type="text" name="username" class="form-control" placeholder="username" required="required">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-8">
              <input type="password" name="password" class="form-control" placeholder="password" required="required">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Ulangi Password</label>
            <div class="col-md-8">
              <input type="password" name="password2" class="form-control" placeholder="ulangi password" required="required">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">&nbsp;</label>
            <div class="col-md-8">
              <input type="submit" name="register" class="btn btn-primary" value="Register">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">&nbsp;</label>
            <div class="col-md-8">
              Sudah punya akun? <a href="login.php">Login</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php include("footer.php"); ?>