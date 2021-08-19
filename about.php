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
            echo '<li class="active"><a href="about.php">About Author</a></li>';
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
    <h1>About Author</h1>
    <hr>
    Kunjungi <a href="http://tutorialweb.net/hubungi-kami/" target="_blank">Web Blog</a>
    <?php include("footer.php"); ?>