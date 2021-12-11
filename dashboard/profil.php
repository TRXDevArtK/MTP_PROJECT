<?php
    ob_start();
    
    include_once "database.php";
    include_once "../sql_connect.php";
    
    $query = "SELECT username,password,email FROM users where id = '".$_SESSION['login_id']."'";
    $sql_run = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $username = $row['username'];
    $password = $row['password'];
    $email = $row['email'];
    
    $query = "SELECT admin FROM users where id = '".$_SESSION['login_id']."'";
    $sql_run = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $admin = $row['admin'];
    $adm_state = 0;
    if($admin === 'yes'){
        $adm_state = 1;
    }
    
    $query = "SELECT *FROM form_data";
    $sql_run = mysqli_query($conn2,$query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $judul = $row['judul'];
    $deskripsi = $row['deskripsi'];
    $link = $row['link'];
    
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <?php include("nav.html"); ?>
        <div class="container"> 
            <ul class="list-group">
                <li class="list-group-item list-group-item-info text-center">Profil Login</li>
                <li class="list-group-item">Username : <?php echo $username; ?></li>
                <li class="list-group-item">Email : <?php echo $email; ?></li>
            </ul>
            
            <?php if(isset($_SESSION['warning'])){ ?>
                <p class="text-center" style="color:green"> <?php echo $_SESSION['warning']; ?> </p>
                <br>
            <?php unset($_SESSION['warning']); } ?>
            <?php if(isset($_SESSION['danger'])){ ?>
                <p class="text-center" style="color:red"> <?php echo $_SESSION['danger']; ?> </p>
                <br>
            <?php unset($_SESSION['danger']); } ?>
            
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title list-group-item list-group-item-warning">
                          <a data-toggle="collapse" href="#collapse0"><b>Ubah Username</b></a>
                      </h4>
                    </div>
                    <div id="collapse0" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form action="profil_opr" method="post">
                                <div class="form-group">
                                    <label>Masukkan Username Baru : </label>
                                    <input type="text" class="form-control" name="username" required="require">
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Username Baru (Konfirmasi) : </label>
                                    <input type="text" class="form-control" name="username_conf" required="require">
                                </div>
                                
                                <input type="submit" name="gantiusername" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title list-group-item list-group-item-warning">
                          <a data-toggle="collapse" href="#collapse1"><b>Ubah Email</b></a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form action="profil_opr" method="post">
                                <div class="form-group">
                                    <label>Masukkan Email Baru : </label>
                                    <input type="text" class="form-control" name="email" required="require">
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Email Baru (Konfirmasi) : </label>
                                    <input type="text" class="form-control" name="email_conf" required="require">
                                </div>
                                
                                <input type="submit" name="gantiemail" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title list-group-item list-group-item-warning">
                          <a data-toggle="collapse" href="#collapse2"><b>Ubah Password</b></a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form action="profil_opr" method="post">
                                <div class="form-group">
                                    <label>Masukkan Password Baru: </label>
                                    <input type="text" class="form-control" name="password" required="require">
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Password Baru (Konfirmasi) : </label>
                                    <input type="text" class="form-control" name="password_conf" required="require">
                                </div>
                                
                                <input type="submit" name="gantipassword" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if($adm_state == 1){ ?>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title list-group-item list-group-item-info">
                          <a data-toggle="collapse" href="#collapse3"><b>TAMBAH AKUN BARU</b></a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p style="color:blue">Kirim akun baru ke email dibawah ini</p>
                            <form action="profil_opr" method="post">
                                <div class="form-group">
                                    <label>Masukkan Email : </label>
                                    <input type="text" class="form-control" name="email" required="require">
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Email (Konfirmasi): </label>
                                    <input type="text" class="form-control" name="email_conf" required="require">
                                </div>
                                <input type="checkbox" id="admin" name="admin_ck" value="">
                                <label> Izinkan akun untuk membuat user baru juga (sama seperti ini)</label><br>
                                <p style="color:red">Perhatian !, pastikan orang yang akan dikirim akun baru merupakan orang terpercaya</p>
                                <p style="color:red">Silahkan nanti di cek email untuk orang yang dikirim, didalamnya sudah ada username dan password yang nanti bisa diubah</p>
                                
                                <input type="submit" name="akunbaru" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title list-group-item list-group-item-info">
                          <a data-toggle="collapse" href="#collapse4"><b>Konfigurasi Form Djazman</b></a>
                      </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form action="profil_opr" method="post">
                                <div class="form-group">
                                    <label>Judul : </label>
                                    <input type="text" class="form-control" name="judul" value="<?php echo $judul ?>"required="require">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi : </label>
                                    <input type="text" class="form-control" name="deskripsi" value="<?php echo $deskripsi ?>" required="require">
                                </div>
                                <div class="form-group">
                                    <label>Link :</label>
                                    <p> <?php echo $_SERVER['HTTP_HOST']."/".$link; ?> </p>
                                    <table class="table table-bordered" style="background-color:white !important;">
                                        <tr>
                                            <td style="text-align:center; vertical-align: middle">
                                                /
                                            </td>
                                            <td width="95%">
                                                <input type="text" class="form-control" name="link_baru" value="<?php echo $link ?>" pattern="[A-Za-z_-]*" 
                                                       oninvalid="this.setCustomValidity('Mohon masukkan link yang benar')" oninput="this.setCustomValidity('')" required="require">
                                            </td>
                                            <input type="hidden" class="form-control" name="link_lama" value="<?php echo $link ?>">
                                        </tr>
                                    </table>
                                </div>
                                <input type="submit" name="form_conf" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } 
            else{} ?>
            
        </div>
    </body>
</html>

