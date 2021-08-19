<?php include("config.php"); ?>
<?php include("body.php"); ?>
<a class="blog-nav-item" href="index.php">Home</a>
          <a class="blog-nav-item" href="upload.php">Upload</a>
          <a class="blog-nav-item active" href="download.php">Download</a>
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
  <h3 class="panel-title">Loker Tugas</h3>
  </div>
  <div class="panel-body">

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
           <td><a href="#" onclick="alert(\'Fitur Download Dimatikan\')" class="btn btn-primary btn-sm">Download</a></td>
          </tr>
          ';
          $no++;
          /*uploads/'.$row['file_name'].'*/
        }
      }else{
        echo '<tr><td colspan="5">Tidak ada data</td></tr>';
      }
      ?>
    </table>
    </div>
          </div>
    <?php
    }
    ?>

<?php include("footer.php"); ?>