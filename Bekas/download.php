<?php include("config.php"); ?>
<?php include("body.php"); ?>
<script>
function sweet (){
swal("Maaf!", "Fitur Downlaod sedang Dimanatikan", "warning");
}
</script>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="upload.php">Upload</a></li>
          <li class="active"><a href="download.php">Download</a></li>
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
    <h1>Loker Tugas</h1>
    <p>Silahlan cek filemu ada atau tidak, seharusnya ada, jika tidak ada berarti kamu <b>JOMBLO</b>, silahkan hub.admin untuk konsultasi.</p>
    <hr>
    <?php
    if(!$_SESSION['user']){
      echo '<div class="alert alert-danger">Anda harus login untuk membuka halaman ini.</div>';
    }else{
      function bytesToSize($bytes, $precision = 2){  
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;
       
        if (($bytes >= 0) && ($bytes < $kilobyte)) {
          return $bytes . ' B';
        } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
          return round($bytes / $kilobyte, $precision) . ' KB';
        } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
          return round($bytes / $megabyte, $precision) . ' MB';
        } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
          return round($bytes / $gigabyte, $precision) . ' GB';
        } elseif ($bytes >= $terabyte) {
          return round($bytes / $terabyte, $precision) . ' TB';
        } else {
          return $bytes . ' B';
        }
      }
    ?>

    <table class="table table-striped table-hover">
      <tr>
        <th>NO.</th>
        <th>FILE NAME</th>
        <th>FILE SIZE</th>
        <th>FILE TYPE</th>
        <th>DOWNLOAD</th>
      </tr>
      <?php
      $sql = $conn->query("SELECT * FROM uploads ORDER BY id DESC");
      if($sql->num_rows > 0){
        $no = 1;
        while($row = $sql->fetch_assoc()){
          echo '
          <tr>
            <td>'.$no.'</td>
            <td>'.$row['file_name'].'</td>
            <td>'.bytesToSize($row['file_size']).'</td>
            <td>'.$row['file_type'].'</td>
           <td><a href="File/pemweb/'.$row['file_name'].'"  class="btn btn-primary btn-sm">Download</a></td>
          </tr>
          ';
          $no++;
          /*uploads/'.$row['file_name'].' onclick="sweet()"*/
        }
      }else{
        echo '<tr><td colspan="5">Tidak ada data</td></tr>';
      }
      ?>
    </table>

    <?php
    }
    ?>

<?php include("footer.php"); ?>