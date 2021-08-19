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
            echo '<li class="active"><a href="admin.php">Admin</a></li>';
          }else{
            echo '<li><a href="about.php">About Author</a></li>';
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
    <h1>Haloo Admin!</h1>
    <?php
    $user="kiki";
    if($_SESSION['user'] == $user){
        $sql = $conn->query("SELECT alamat FROM url");
        if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();
        $url = $row['alamat'];
        }
        $sql2 = $conn->query("SELECT * FROM info");
        if($sql2->num_rows > 0){
        $row = $sql2->fetch_assoc();
        $info1 = $row['info1'];
        $info2 = $row['info2'];
        }

        $sql3 = $conn->query("SELECT COUNT(id) As jml FROM uploads");
        $row1 = $sql3->fetch_assoc();
        $up = $row1['jml'];


        
    ?>
 <br/>


<?php
//Info File
if($_POST['info']){
$uinfo1 = $_POST['uinfo1'];
$uinfo2 = $_POST['uinfo2'];
$insert = $conn->query("UPDATE info SET info1 = '$uinfo1', info2='$uinfo2' ");
           if($insert){
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Berhasil!',
               text:  'Info telah di update! ',
               icon: 'success',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
           }else{
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Gagal!',
               text:  'Info gagal di update! ',
               icon: 'error',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
             exit;
           }
       }
?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12">
            <label for="exampleInputEmail1">Info 1</label>
            <textarea name="uinfo1" class="form-control" rows="3"><?= $info1?></textarea><br>
            <label for="exampleInputEmail1">Info 2</label>
            <textarea name="uinfo2" class="form-control" rows="3"><?= $info2?></textarea><br>
            <input type="submit"  onclick="sweet()" name="info" class="btn btn-success" value="Update"><hr>
        
      </div>
    </form>

    <?php
//Lokasi File
if($_POST['pindah']){
    rename('File/'.$url , 'File/Arsip/'.$url);
    echo "<script type='text/javascript'>
    setTimeout(function () {  
     swal({
      title: 'Berhasil!',
      text:  'Data telah di Arsipkan! ',
      icon: 'success',
      timer: 3000,
      showConfirmButton: true
     });  
    },10); 
    window.setTimeout(function(){ 
     window.location.replace('admin.php');
    } ,3000); 
   </script>";
}


if($_POST['new']){
$urlb = $_POST['urlb'];
$insert1 = $conn->query("UPDATE url SET alamat = '$urlb' ");
mkdir("File/".$urlb);
           if($insert1){
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Berhasil!',
               text:  'Lokasi telah di update! ',
               icon: 'success',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
           }else{
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Gagal!',
               text:  'Lokasi gagal di update! ',
               icon: 'error',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
             exit;
           }
       }
?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12">
            <label for="exampleInputEmail1">Lokasi File</label>
            <li> Usahakan gunakan nama yang belum pernah di gunakan</b></li><br/>
            <input type="text" name="urlb" class="form-control" value= <?php echo $url?>><br>
            <input type="submit" name="new" class="btn btn-success" value="Update">
            <a href="File/<?php echo $url?>" class="btn btn-primary">Cek Lokasi</a><hr>
      </div>
    </form>

<?php
if($_POST['zip']){
$text = $_POST['text_zip'];
$zip = new ZipArchive();
$zip->open('compressed/'.$text.'.zip', ZipArchive::CREATE);
 
$options = array('add_path' => 'rar/', 'remove_all_path' => TRUE);
$zip->addGlob('File/'.$url.'*.rar', 0, $options);
 
$options = array('add_path' => 'php/', 'remove_all_path' => TRUE);
$zip->addGlob('File/'.$url.'*.php', 0, $options);
 
$options = array('add_path' => 'word/', 'remove_all_path' => TRUE);
$zip->addGlob('File/'.$url.'*.{docx, doc}', GLOB_BRACE, $options);
  
$zip->close();

echo"<meta http-equiv='refresh' content='1;url=compressed/$text.zip'>";
echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Berhasil!',
               text:  'Data telah di Kompres! ',
               icon: 'success',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
}
?>

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12">
            <label for="exampleInputEmail1">Compress File</label>
            <li> Zip data pada Folder <b><?= $url?></b></li><br/>
            <input type="text" name="text_zip" class="form-control"  placeholder="EtikaProfesi"><br>
            <input type="submit" name="zip" class="btn btn-info" value="Compress & Download">
            <input type="submit" name="pindah" class="btn btn-warning" value="Arsipkan"><hr>
      </div>
    </form>

    
    <?php
//Delete Data

if($_POST['delete']){
$insert = $conn->query("DELETE from uploads");
           if($insert){
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Berhasil!',
               text:  'Data telah di delete! ',
               icon: 'success',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
           }else{
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Gagal!',
               text:  'Data gagal di delete! ',
               icon: 'error',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
             exit;
           }
       }
?>
<?php
//Delete Data2

if($_POST['delete2']){
$filename = $_POST['filename'];
unlink('File/'.$url.'/'.$filename);
$insert = $conn->query("DELETE from uploads where file_name ='$filename'");
           if($insert){
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Berhasil!',
               text:  'Data telah di delete! ',
               icon: 'success',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
           }else{
             echo "<script type='text/javascript'>
             setTimeout(function () {  
              swal({
               title: 'Gagal!',
               text:  'Data gagal di delete! ',
               icon: 'error',
               timer: 3000,
               showConfirmButton: true
              });  
             },10); 
             window.setTimeout(function(){ 
              window.location.replace('admin.php');
             } ,3000); 
            </script>";
             exit;
           }
       }
?>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12">
        <label for="exampleInputEmail1">Delete Data in database</label><br>
        <p> Jumlah Data:  <?= $up; ?></p>
        <input type="submit" name="delete" class="btn btn-danger" value="Delete data"><br>
        <br><label for="exampleInputEmail1">Delete Data in hosting & database</label>
        <br><input type="text" name="filename" class="form-control"  placeholder="EtikaProfesi"><br>
        <input type="submit" name="delete2" class="btn btn-danger" value="Delete file"><hr>
      </div>
    </form>
    <br><br><br><br><br><br><br><br><br>

    <?php
    }else{
    echo '<div class="alert alert-danger">KAMU BUKAN ADMIN.</div>';
    }
    ?>
    
<?php include("footer.php"); ?>