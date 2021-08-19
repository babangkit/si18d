<?php include("config.php"); ?>
<?php include("body.php"); ?>
<a class="blog-nav-item" href="index.php">Home</a>
          <a class="blog-nav-item" href="upload.php">Upload</a>
          <a class="blog-nav-item" href="download.php">Download</a>
           <?php
           $user="kiki";
           if($_SESSION['user'] == $user){
            echo '<a class="blog-nav-item active" href="admin.php">Admin</a>';
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
    <h1>Haloo Admin!</h1>
    <br>
    <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Control Panel</h3>
            </div>
            <div class="panel-body">

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
//Info File -- Popup SweetAlert2
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
        <div class="col-xs-12">
            <label for="exampleInputEmail1">Info 1</label>
            <textarea name="uinfo1" class="form-control" rows="3"><?= $info1?></textarea><br>
            <label for="exampleInputEmail1">Info 2</label>
            <textarea name="uinfo2" class="form-control" rows="3"><?= $info2?></textarea><br>
            <input type="submit"  onclick="sweet()" name="info" class="btn btn-success" value="Update"><hr>
        </div>
      </div>
    </form>



<?php

if($_POST['matkul']){
  $id_mtk = $_POST['matk'];
  $insert2 = $conn->query("UPDATE info_2 SET id_matkul = '$id_mtk'");
           if($insert2){
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
        <div class="col-xs-12">
        <p>Pilih tugas matkul yang akan dikumpulkan:</p>
        <select name="matk">
        <option value="1">Etika Profesi SI</option>
        <option value="2">Dasar-dasar Pengembangan Perangkat Lunak</option>
        <option value="3">Bahasa Inggris 1</option>
        <option value="4">Pendidikan Pancasila dan Kewarganegaraan</option>
        <option value="5">Pemrograman Berorientasi Objek</option>
        <option value="6">Jaringan Komputer</option>
        <option value="7">Pemrograman Web</option>
        </select><br><br>
        <input type="submit" class="btn btn-success" name="matkul" value="Update"/><hr>
        </div>
      </div>
    </form>


    <?php

if($_POST['hari1']){
  $id_h = $_POST['hari'];
  $jam = $_POST['jam'];
  $insert2 = $conn->query("UPDATE id_hari SET id_hari = '$id_h' WHERE id=1");
  $insert1 = $conn->query("UPDATE hari SET nama = '$jam' WHERE id=10");
           if($insert2){
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

<?php
        $sql3 = $conn->query("SELECT * FROM hari WHERE id=10");
        if($sql3->num_rows > 0){
          $row = $sql3->fetch_assoc();
          $jam = $row['nama'];
        }
?>

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12">
        <div class="col-xs-12">
        <p>Pilih hari terakhir pengumpulan tugas:</p>
        <select name="hari">
        <option value="1">Senin</option>
        <option value="2">Selasa</option>
        <option value="3">Rabu</option>
        <option value="4">Kamis</option>
        <option value="5">Jum'at</option>
        <option value="6">Sabtu</option>
        <option value="7">Minggu</option>
        </select><br><br>
        <p>Inputkan Jam terakhir pengumpulan tugas:</p>
        </div>
        <div class="col-xs-6">
        <input type="text" name="jam" class="form-control" value="<?= $jam?>"><br>
        <br>
        <input type="submit" class="btn btn-success" name="hari1" value="Update"/><hr>
        </div>
      </div>
    </form>


    <?php

if($_POST['aktiva']){
  $aktiv = $_POST['aktiv'];
  $insert1 = $conn->query("UPDATE aktifasi SET isi = '$aktiv' WHERE id=1");
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
<?php
 $sql5 = $conn->query("SELECT isi FROM aktifasi");
      if($sql5->num_rows > 0){
        $row = $sql5->fetch_assoc(); 
        $aktiff = $row['isi'];
      }
      if($aktiff == 0){
        $aaktiv = 'Halaman Upload tidak aktif';
      }else{
        $aaktiv = 'Halaman Upload Aktif';
      }
?>

    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group col-xs-12">
        <div class="col-xs-12">
        <p>Aksi Untuk Halaman Upload:</p>
        <input type="radio" name="aktiv" value="1" checked>Aktif<br/>  
        <input type="radio" name="aktiv" value="0">Tidak<br/>
        <br><p>Status: <b><?= $aaktiv ?></b></p>  
        <br>
        <input type="submit" class="btn btn-success" name="aktiva" value="Update"/><hr>
        </div>
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
        <div class="col-xs-12">
            <label for="exampleInputEmail1">Lokasi File</label>
            <li> Usahakan gunakan nama yang belum pernah di gunakan</b></li><br/>
            <input type="text" name="urlb" class="form-control" value= <?php echo $url?>><br>
            <input type="submit" name="new" class="btn btn-success" value="Update">
            <a href="File/<?php echo $url?>" class="btn btn-primary">Cek Lokasi</a><hr>
        </div>
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
        <div class="col-xs-12">
            <label for="exampleInputEmail1">Compress File</label>
            <li> Zip data pada Folder <b><?= $url?></b></li><br/>
            <input type="text" name="text_zip" class="form-control"  placeholder="EtikaProfesi"><br>
            <input type="submit" name="zip" class="btn btn-info" value="Compress & Download">
            <input type="submit" name="pindah" class="btn btn-warning" value="Arsipkan"><hr>
        </div>
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
        <div class="col-xs-12">
        <label for="exampleInputEmail1">Delete Data</label><br>
        <p> Jumlah Data:  <?= $up; ?></p>
        <input type="submit" name="delete" class="btn btn-danger" value="Delete data"><br>
        <br><label for="exampleInputEmail1">Delete Data in hosting & database</label>
        <br><input type="text" name="filename" class="form-control"  placeholder="EtikaProfesi"><br>
        <input type="submit" name="delete2" class="btn btn-danger" value="Delete file"><hr>
        </div>
      </div>
    </form>
    <br><br><br><br><br><br><br><br><br>

    <?php
    }else{
    echo '<div class="alert alert-danger">KAMU BUKAN ADMIN.</div>';
    }
    ?>
   </div>
  </div>
<?php include("footer.php"); ?>